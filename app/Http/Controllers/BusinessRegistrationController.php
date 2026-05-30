<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;
use Illuminate\Support\Str;

class BusinessRegistrationController extends Controller
{
    /**
     * Show the business registration form.
     */
    public function create()
    {
        $categories = ['Restauración', 'Alimentación', 'Servicios', 'Salud y Belleza', 'Peluquerías', 'Otros'];
        return view('register-business', compact('categories'));
    }

    /**
     * Store a newly created business in storage pending moderation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:businesses,name',
            'description' => 'required|string|min:10|max:1000',
            'category' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
        ], [
            'name.required' => 'El nombre del negocio es obligatorio.',
            'name.unique' => 'Este nombre de negocio ya se encuentra registrado o solicitado.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres para que tus vecinos conozcan bien tu negocio.',
            'category.required' => 'Debes seleccionar una categoría.',
            'address.required' => 'La dirección física es obligatoria.',
            'latitude.required' => 'Debes ubicar tu negocio en el mapa para obtener la latitud.',
            'latitude.numeric' => 'La latitud debe ser un valor numérico válido.',
            'longitude.required' => 'Debes ubicar tu negocio en el mapa para obtener la longitud.',
            'longitude.numeric' => 'La longitud debe ser un valor numérico válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico de contacto es obligatorio.',
            'email.email' => 'Introduce un formato de correo electrónico válido.',
            'website.url' => 'Si introduces un sitio web, este debe tener un formato de URL válido (ej: https://tupagina.com).',
        ]);

        // Generate unique slug
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug uniqueness (in case name uniqueness passes but slug conflicts)
        $count = Business::where('slug', $validated['slug'])->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        $validated['is_approved'] = false;
        $validated['is_featured'] = false;

        Business::create($validated);

        return back()->with('success', '¡Solicitud recibida con éxito! Revisaremos tu comercio y lo publicaremos en el Marketplace en cuanto sea aprobado.');
    }
}
