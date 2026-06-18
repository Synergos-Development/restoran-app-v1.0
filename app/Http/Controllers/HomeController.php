<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::where('is_available', true)
            ->with('category')
            ->take(6)
            ->get();

        $reviews = \App\Models\Review::where('approved', true)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('menus', 'reviews'));
    }
}
