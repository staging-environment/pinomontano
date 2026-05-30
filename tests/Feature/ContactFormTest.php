<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ContactMessage;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a user can submit the contact form with valid data.
     */
    public function test_user_can_submit_contact_form_with_valid_data(): void
    {
        $response = $this->post('/contacto', [
            'name' => 'Vecino Colaborador',
            'email' => 'vecino@ejemplo.com',
            'subject' => 'Propuesta de mejora',
            'message' => 'Hola, me encanta el marketplace de Pino Montano. Buen trabajo.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('contact_success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Vecino Colaborador',
            'email' => 'vecino@ejemplo.com',
            'subject' => 'Propuesta de mejora',
            'message' => 'Hola, me encanta el marketplace de Pino Montano. Buen trabajo.',
        ]);
    }

    /**
     * Test the contact form validation rules.
     */
    public function test_contact_form_validation_errors(): void
    {
        // 1. Missing required fields
        $response = $this->post('/contacto', [
            'name' => '',
            'email' => '',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('contact_messages', 0);

        // 2. Message too short (min: 10)
        $response2 = $this->post('/contacto', [
            'name' => 'Vecino',
            'email' => 'vecino@ejemplo.com',
            'message' => 'Corto',
        ]);

        $response2->assertSessionHasErrors(['message']);
        $this->assertDatabaseCount('contact_messages', 0);
    }
}
