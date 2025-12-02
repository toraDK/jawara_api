<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\JsonResponse;

class FamilyController extends Controller
{

    public function index(): JsonResponse
    {
        $families = Family::with('house', 'citizens')->get();
        return response()->json($families);
    }

    /**
     * Get options for select input (dropdown)
     * Format: [{id: 1]
     */
    public function options(): JsonResponse
    {
        $families = Family::where('status', 'active')
            ->with(['citizens' => function ($query) {
                $query->where('family_role', 'Kepala Keluarga');
            }])
            ->get()
            ->map(function ($family) {
                $headOfFamily = $family->citizens->first();
                $name = $headOfFamily ? $headOfFamily->name : 'Tanpa Kepala Keluarga';

                return [
                    'id'    => $family->id,
                    'family_name' => $name
                ];
            });

        return response()->json($families);
    }
}
