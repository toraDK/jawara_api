<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mutation\StoreMutationRequest;
use App\Models\Family;
use App\Models\Mutation;
use Illuminate\Http\JsonResponse;

class MutationController extends Controller
{
    /**
     * D.1 List Mutasi
     * Data: Tanggal, Nama Keluarga, Jenis Mutasi
     */
    public function index(): JsonResponse
    {
        // Ambil mutasi, load keluarga, dan cari siapa kepala keluarganya
        $mutations = Mutation::with(['family.citizens' => function ($query) {
            $query->where('family_role', 'Kepala Keluarga');
        }])
            ->orderBy('mutation_date', 'desc')
            ->get()
            ->map(function ($mutation) {

                // Logika mencari Nama Keluarga:
                // 1. Cek ada warga dgn role 'Kepala Keluarga' gak?
                // 2. Kalau gak ada, pakai Nama Keluarga (jika ada field itu), atau pakai No KK.

                $headOfFamily = $mutation->family->citizens->first();

                // Fallback nama jika data citizen belum lengkap
                $familyName = $headOfFamily ? $headOfFamily->name : ('Keluarga KK: ' . $mutation->family->kk_number);

                return [
                    'id'            => $mutation->id,
                    'date'          => $mutation->mutation_date, // Tanggal
                    'family_name'   => $familyName,              // Nama Keluarga
                    'mutation_type' => $mutation->mutation_type, // Jenis Mutasi
                    'reason'        => $mutation->reason         // Alasan (Opsional ditampilkan)
                ];
            });

        return response()->json([
            'status' => 'success',
            'data'   => $mutations
        ]);
    }

    /**
     * D.2 Buat Mutasi
     * Data: Jenis, Keluarga, Alasan, Tanggal
     */
    public function store(StoreMutationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $family = Family::findOrFail($validated['family_id']);

        $mutation = Mutation::create([
            'family_id'     => $validated['family_id'],
            'house_id'      => $family->house_id,
            'mutation_type' => $validated['mutation_type'], // Kirim 'move_out', bukan 'pindah_keluar'
            'mutation_date' => $validated['mutation_date'],
            'reason'        => $validated['reason'],
        ]);

        // PERBAIKAN LOGIC: Cek 'move_out'
        if ($validated['mutation_type'] === 'move_out') {
            $family->update(['status' => 'moved']);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Mutation recorded successfully',
            'data'    => $mutation
        ], 201);
    }
}
