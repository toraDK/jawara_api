<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HouseController extends Controller
{

    // public function options()
    // {
    //     $houses = House::select('id', 'house_name')
    //         ->orderBy('house_name')
    //         ->get();

    //     return response()->json($houses);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(): jsonResponse
    {
        $houses = House::select('id', 'house_name')
            ->orderBy('house_name')
            ->get();

        // return response()->json($houses);
        return response()->json([
            'status'  => 'success',
            'message' => 'Houses retrieved successfully',
            'data'    => $houses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): jsonResponse
    {
        //
        $validated = $request->validate();

        // $validated['status'] = 'active';

        $house = House::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'House created successfully',
            'data'    => $house
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
