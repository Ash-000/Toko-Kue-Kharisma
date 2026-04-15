<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;

class AuthController extends Controller
{
    public function showHome()
    {
        $products = Product::take(4)->get();
        $reviews = Review::latest()->get();
        return view('home', compact('products', 'reviews'));
    }

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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile')
                ->with('password_error', 'Password saat ini tidak sesuai.')
                ->withFragment('settings');
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('profile')
            ->with('password_success', 'Password berhasil diubah.')
            ->withFragment('settings');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Try to authenticate with database
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if admin (role-based)
            $isAdmin = $user->role === 'admin';
            session(['user_logged_in' => true, 'is_admin' => $isAdmin, 'user_name' => $user->name]);

            if ($isAdmin) {
                return redirect('/admin');
            }

            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create user in database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
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
