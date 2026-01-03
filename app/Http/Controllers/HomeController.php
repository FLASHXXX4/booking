<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredHotels = Hotel::whereIn('city', ['Marrakech', 'Casablanca', 'Rabat', 'Tangier'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $cities = ['Marrakech', 'Casablanca', 'Rabat', 'Tangier', 'Fes', 'Agadir'];

        return view('home', compact('featuredHotels', 'cities'));
    }
}
