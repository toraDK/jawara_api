<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * C.1 Semua Aktifitas (List)
     */
    public function index(): JsonResponse
    {
        // Mengambil data urut dari yang terbaru
        // Kita gunakan select() agar payload ringan, sesuai request C.1
        $activities = Activity::orderBy('activity_date', 'desc')
            ->select([
                'id',
                'name',
                'activity_date',
                'description',
                'status', // Opsional: biasanya status juga penting ditampilkan
                'category' // Opsional: untuk filter icon di frontend
            ])
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $activities
        ]);
    }

    // Nanti kita tambahkan method store() disini jika ingin fitur Tambah Kegiatan
}
