<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;

class AuthController extends Controller
{
    /**
     * Menampilkan Halaman Home
     */
    public function showHome()
    {
        // Tampilkan 4 produk dengan pemesanan terbanyak (exclude paket promo)
        // Hitung dari order_items, join ke products
        $products = Product::where('category', '!=', 'Paket Promo')
            ->withCount(['orderItems as total_ordered' => function ($query) {
                $query->selectRaw('COALESCE(SUM(quantity), 0)');
            }])
            ->orderByDesc('total_ordered')
            ->orderBy('id') // tiebreaker
            ->take(4)
            ->get();

        // Fallback: jika semua produk belum pernah dipesan, tetap tampilkan 4 produk pertama
        if ($products->every(fn ($p) => $p->total_ordered == 0)) {
            $products = Product::where('category', '!=', 'Paket Promo')
                ->orderBy('id')
                ->take(4)
                ->get();
        }

        // Pagination untuk reviews - 5 per halaman
        $reviews      = Review::latest()->paginate(5);
        $totalReviews = Review::count();

        return view('home', compact('products', 'reviews', 'totalReviews'));
    }

    /**
     * Menampilkan Halaman Profil & Riwayat Pesanan
     */
    public function showProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        $orders = Order::with('orderItems.product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile', compact('user', 'orders'));
    }

    /**
     * Update Informasi Profil & Alamat Pengiriman
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        // Filter: Hanya ambil data yang tidak null agar tidak menimpa data lama
        $dataUpdate = array_filter($validated, function ($value) {
            return !is_null($value);
        });

        // Proses upload foto profil jika ada
        if ($request->hasFile('photo')) {
            $file     = $request->file('photo');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('avatars', $filename, 'public');

            // Hapus foto lama jika bukan default
            if ($user->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->photo);
            }

            $dataUpdate['photo'] = $path;
        }

        $user->update($dataUpdate);

        $pesan = $request->has('address') ? 'Alamat pengiriman berhasil diperbarui!' : 'Informasi profil berhasil diperbarui!';

        return redirect()->route('profile')->with('success', $pesan);
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'password'     => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('profile')
                ->with('error', 'Password saat ini tidak sesuai.')
                ->withFragment('settings');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile')
            ->with('success', 'Kata sandi berhasil diupdate!')
            ->withFragment('settings');
    }

    /**
     * Auth Functions (Login, Register, Logout)
     */
    public function showLogin() { return view('login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            $isAdmin = $user->role === 'admin';
            session([
                'user_logged_in' => true, 
                'is_admin' => $isAdmin, 
                'user_name' => $user->name
            ]);

            return $isAdmin ? redirect('/admin') : redirect()->intended('/profile');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function showRegister() { return view('register'); }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        session(['user_logged_in' => true, 'is_admin' => false, 'user_name' => $user->name]);

        return redirect('/profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}