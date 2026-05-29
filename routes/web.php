<?php

use Illuminate\Support\Facades\Route;

use App\Models\Business;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $search = $request->input('search');
    $category = $request->input('category');

    $query = Business::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%");
        });
    }

    if ($category) {
        $query->where('category', $category);
    }

    $businesses = $query->orderBy('is_featured', 'desc')
                        ->orderBy('name', 'asc')
                        ->get();

    $categories = Business::distinct()->orderBy('category')->pluck('category');

    return view('welcome', compact('businesses', 'categories', 'search', 'category'));
});
