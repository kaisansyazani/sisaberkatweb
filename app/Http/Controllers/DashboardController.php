<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waste;

class DashboardController extends Controller
{
    public function index()
    {
        $wastes = Waste::where('user_id', auth()->id())->latest()->take(5)->get();
        $totalWastes = $wastes->count();
        $totalWeight = $wastes->sum('weight');
        $totalEarnings = $wastes->sum('price');

        return view('dashboard', compact(
            'wastes',
            'totalWastes',
            'totalWeight',
            'totalEarnings'
        ));
    }
}