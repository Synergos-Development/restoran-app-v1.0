<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Placeholder: replace with dynamic images later
        $images = [
            '/images/gallery/1.png',
            '/images/gallery/2.png',
            '/images/gallery/3.png',
            '/images/gallery/4.png',
        ];

        return view('gallery.index', compact('images'));
    }
}
