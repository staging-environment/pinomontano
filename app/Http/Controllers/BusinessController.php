<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Review;
use App\Services\ProfanityFilter;

class BusinessController extends Controller
{
    /**
     * Display the business details page with reviews.
     */
    public function show($slug)
    {
        $business = Business::where('slug', $slug)
            ->where('is_approved', true)
            ->firstOrFail();

        $reviews = $business->reviews()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('business-details', compact('business', 'reviews'));
    }

    /**
     * Store a new review for the business.
     */
    public function storeReview(Request $request, $slug)
    {
        $business = Business::where('slug', $slug)
            ->where('is_approved', true)
            ->firstOrFail();

        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ], [
            'author_name.required' => 'El nombre es obligatorio.',
            'rating.required' => 'La valoración por estrellas es obligatoria.',
            'rating.integer' => 'La valoración debe ser un número entero.',
            'rating.min' => 'La valoración mínima es 1 estrella.',
            'rating.max' => 'La valoración máxima es 5 estrellas.',
            'comment.required' => 'El comentario es obligatorio.',
            'comment.min' => 'El comentario debe tener al menos 5 caracteres.',
            'comment.max' => 'El comentario no puede exceder los 1000 caracteres.',
        ]);

        $containsProfanity = ProfanityFilter::hasProfanity($validated['comment']) || ProfanityFilter::hasProfanity($validated['author_name']);

        $review = new Review([
            'business_id' => $business->id,
            'author_name' => $validated['author_name'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => !$containsProfanity,
        ]);

        $review->save();

        if ($containsProfanity) {
            return back()->with('warning', 'Tu comentario contiene palabras que requieren revisión y ha quedado pendiente de aprobación por un administrador.');
        }

        return back()->with('success', '¡Gracias por tu valoración! Tu opinión se ha publicado correctamente.');
    }
}
