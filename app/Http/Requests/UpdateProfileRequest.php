<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = Auth::id();
        return [
            'name'      => 'nullable|string|max:255',
            'email'     => 'nullable|email|unique:users,email,' . $userId,
            'phone'     => 'nullable|string|max:20|unique:users,phone,' . $userId,
            'address'   => 'nullable|string|max:500',
            'latitude'  => 'nullable|string',
            'longitude' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'gender'    => 'nullable|string',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'phone.unique' => 'Nomor telepon sudah digunakan oleh akun lain.',
        ];
    }
}
