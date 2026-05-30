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

    $businesses = $query->where('is_approved', true)
                        ->withAvg(['reviews' => function ($q) {
                            $q->where('is_approved', true);
                        }], 'rating')
                        ->orderByRaw('COALESCE(reviews_avg_rating, 0) DESC')
                        ->orderBy('is_featured', 'desc')
                        ->orderBy('name', 'asc')
                        ->get();

    $categories = ['Restauración', 'Alimentación', 'Servicios', 'Salud y Belleza', 'Peluquerías', 'Otros'];

    return view('welcome', compact('businesses', 'categories', 'search', 'category'));
});

use App\Http\Controllers\BusinessRegistrationController;

Route::get('/unirse', [BusinessRegistrationController::class, 'create'])->name('business.register');
Route::post('/unirse', [BusinessRegistrationController::class, 'store'])->name('business.store');

Route::get('/historia', function () {
    return view('historia');
})->name('barrio.history');
Route::get('/de-donde-vinimos', function () {
    return view('de-donde-vinimos');
})->name('barrio.origins');

Route::get('/hacia-donde-vamos', function () {
    return view('hacia-donde-vamos');
})->name('barrio.future');

use App\Http\Controllers\BusinessController;

Route::get('/negocio/{slug}', [BusinessController::class, 'show'])->name('business.show');
Route::post('/negocio/{slug}/resena', [BusinessController::class, 'storeReview'])->name('business.review.store');

use App\Http\Controllers\ContactController;

Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');
