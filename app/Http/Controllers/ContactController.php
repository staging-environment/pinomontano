<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'message.max' => 'El mensaje no puede exceder los 2000 caracteres.',
        ]);

        ContactMessage::create($validated);

        try {
            // 1. Notificación al administrador
            \Illuminate\Support\Facades\Mail::raw(
                "Nuevo mensaje de contacto en el Marketplace de Pino Montano:\n\n" .
                "Nombre: " . $validated['name'] . "\n" .
                "Email: " . $validated['email'] . "\n" .
                "Asunto: " . ($validated['subject'] ?? 'Sin asunto') . "\n\n" .
                "Mensaje:\n" . $validated['message'],
                function ($message) use ($validated) {
                    $message->from('info@pinomontano.es', 'Marketplace Pino Montano')
                            ->to('jarodriguezbonilla@gmail.com')
                            ->subject('Nuevo mensaje de contacto: ' . ($validated['subject'] ?? 'General'))
                            ->replyTo($validated['email'], $validated['name']);
                }
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error al enviar correo de contacto (admin): ' . $e->getMessage());
        }

        try {
            // 2. Auto-respuesta al visitante
            \Illuminate\Support\Facades\Mail::raw(
                "Hola " . $validated['name'] . ",\n\n" .
                "Hemos recibido tu mensaje correctamente en el Marketplace de Pino Montano. Nuestro equipo revisará tu consulta y te responderá lo antes posible.\n\n" .
                "Copia de tu mensaje:\n" .
                "----------------------------------------\n" .
                $validated['message'] . "\n" .
                "----------------------------------------\n\n" .
                "Un saludo,\n" .
                "El equipo de Pino Montano.",
                function ($message) use ($validated) {
                    $message->from('info@pinomontano.es', 'Marketplace Pino Montano')
                            ->to($validated['email'])
                            ->subject('Hemos recibido tu mensaje - Marketplace Pino Montano');
                }
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error al enviar auto-respuesta de contacto: ' . $e->getMessage());
        }

        return redirect(url()->previous() . '#contacto')->with('contact_success', '¡Gracias por contactar con nosotros! Hemos recibido tu mensaje correctamente y nos pondremos en contacto contigo lo antes posible.');
    }
}
