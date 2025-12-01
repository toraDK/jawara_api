<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Sesuaikan jika butuh cek role admin
    }

    public function rules(): array
    {
        // Ambil ID dari URL (route parameter)
        $userId = $this->route('id');

        return [
            'name'     => 'required|string|max:255',
            // unique:users,email,ID_YG_DIKECUALIKAN
            'email'    => 'required|email|unique:users,email,' . $userId,
            'phone'    => 'required|string|max:15',
            'password' => 'nullable|string|min:6', // Password opsional saat edit
            'role'     => 'required|in:admin,resident,treasurer',
        ];
    }
}
