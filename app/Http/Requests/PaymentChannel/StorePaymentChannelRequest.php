<?php

namespace App\Http\Requests\PaymentChannel;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentChannelRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Ubah ke true, atau tambahkan logika cek role admin disini
        // return auth()->user()->role === 'admin';
        return true;
    }

    public function rules(): array
    {
        return [
            'channel_name'   => 'required|string|max:50',
            'type'           => 'required|in:bank,ewallet',
            'account_number' => 'required|numeric', // Pastikan angka
            'account_name'   => 'required|string|max:100',
            // Validasi gambar: wajib image, max 2MB
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'qr_code'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes'          => 'nullable|string',
        ];
    }
}
