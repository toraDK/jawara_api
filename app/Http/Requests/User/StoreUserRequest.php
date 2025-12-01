<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya admin yang boleh akses (bisa dihandle middleware juga)
        // return auth()->user()->role === 'admin';
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255', // Nama Lengkap
            'email'    => 'required|email|unique:users,email', // Email (harus unik)
            'phone'    => 'required|string|max:15', // Nomor HP
            'password' => 'required|string|min:6', // Password
            'role'     => 'required|in:admin,resident,treasurer', // Role
        ];
    }
}
