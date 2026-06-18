<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Placeholder: replace with dynamic images later
        $images = [
            '/images/gallery/1.jpg',
            '/images/gallery/2.jpg',
            '/images/gallery/3.jpg',
            '/images/gallery/4.jpg',
        ];

        return view('gallery.index', compact('images'));
    }
}
