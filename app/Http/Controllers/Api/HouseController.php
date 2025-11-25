<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;

class HouseController extends Controller
{
    public function options()
    {
        $houses = House::select('id', 'house_name')
            ->orderBy('house_name')
            ->get();

        return response()->json($houses);
    }
}
