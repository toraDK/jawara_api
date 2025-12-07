<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function mainDashboard(): JsonResponse
    {
        $data = [
            'total population' => [
                'male population' => 1000, // laki - laki
                'female population' => 1000, // perempuan
            ], // total populasi
            'total families' => 500, // total keluarga
            'total activity' => [
                'completed' => 120,
                'upcoming' => 30,
                'ongoing' => 10,
            ], // total aktivitas
            'cash' => [
                'total cash' => 7500000, // total kas
                'income' => 5000000, // total pemasukan
                'expense' => 2500000, // total pengeluaran
            ],
            'new activity' => ['activity1', 'activity2', 'activity3']
        ];

        return response()->json($data);
    }

    public function financeDashboard(): JsonResponse
    {
        // Logic to gather finance dashboard data
        $data = [
            'total_income' => 1000000,
            'total_expense' => 500000,
            'total cash' => 500000,
            'transactions' => 3,
            'income_per_month' => [
                'January' => 200000,
                'February' => 300000,
                'March' => 500000,
            ],
            'expense_per_month' => [
                'January' => 100000,
                'February' => 200000,
                'March' => 200000,
            ],
            'income_per_category' => [
                'government aid funds' => 600000,
                'other income' => 400000,
            ],
            'expense_per_category' => [
                'RT/RW operational' => 300000,
                'facility maintenance' => 200000,
                'community activities' => 200000,
            ],
        ];

        return response()->json($data);
    }

    public function activityDashboard(): JsonResponse
    {
        // Logic to gather activity dashboard data
        $data = [
            'total_activities' => 150,
            'upcoming_activities' => 5,
            'ongoing_activities' => 5,
            'complete_activities' => 5,
            'type of activity' => [
                'community and social' => 50,
                'cleaning and security' => 30,
                'religious' => 70,
                'education' => 70,
                'health and sports' => 70,
                'other' => 70,
            ],
            'activities_per_month' => [
                'January' => 10,
                'February' => 15,
                'March' => 20,
            ],
        ];

        return response()->json($data);
    }

    public function populationDashboard(): JsonResponse
    {
        // Logic to gather population dashboard data
        $data = [
            'total_families' => 500,
            'total_population' => 2000,
            'status_distribution' => [
                'active' => 1800,
                'inactive' => 200,
            ],
            'gender_distribution' => [
                'male' => 1000,
                'female' => 1000,
            ],
            'work_status_distribution' => [
                'student' => 1200,
                'other' => 800,
            ],
            'roles_distribution' => [
                'head of family' => 500,
                'child' => 800,
                'other' => 300,
            ],
            'religion_distribution' => [
                'islam' => 1500,
                'christianity' => 300,
                'hinduism' => 100,
                'buddhism' => 50,
                'other' => 50,
            ],
            'education_level_distribution' => [
                'elementary school' => 500,
                'junior high school' => 400,
                'senior high school' => 600,
                'diploma' => 100,
            ],
        ];
        return response()->json($data);
    }
}
