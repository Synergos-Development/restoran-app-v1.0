<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query()->where('is_available', true)->with('category');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $menus = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('menu.index', compact('menus', 'categories'));
    }

    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }
}
