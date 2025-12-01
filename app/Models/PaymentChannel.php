<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Import ini

class PaymentChannel extends Model
{
    protected $fillable = [
        'channel_name', 'type', 'account_number', 'account_name',
        'thumbnail', 'qr_code', 'notes', 'is_active'
    ];

    // Otomatis convert boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // --- Accessor untuk URL Gambar ---

    // Saat frontend panggil $item->thumbnail_url
    protected $appends = ['thumbnail_url', 'qr_code_url'];

    // Sembunyikan kolom asli supaya JSON lebih bersih
    protected $hidden = ['thumbnail', 'qr_code'];

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? url('storage/' . $this->thumbnail) : null;
    }

    public function getQrCodeUrlAttribute()
    {
        return $this->qr_code ? url('storage/' . $this->qr_code) : null;
    }
}
