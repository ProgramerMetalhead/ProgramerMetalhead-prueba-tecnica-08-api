<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Prospect;

class ProspectApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase; // <--- Fundamental para reiniciar la DB
    
    public function test_crea_un_prospecto_exitosamente(): void
    {
        $payload = [
            'name' => 'Juan Perez',
            'phone' => '1234567890',
        ];

        // Hacemos la petición POST
        $response = $this->postJson('/api/prospects', $payload);

        // Validamos la respuesta HTTP
        $response->assertStatus(201)
                ->assertJsonStructure([
                    'message', 
                    'data' => ['id', 'name', 'phone', 'status']
                ]);

        // Validamos que exista físicamente en la base de datos
        $this->assertDatabaseHas('prospects', [
            'name' => 'Juan Perez',
            'phone' => '1234567890',
            'status' => 1, // true se guarda como 1
        ]);
    }

    public function test_falla_si_faltan_datos_o_telefono_invalido(): void
    {
        $payload = [
            'name' => '', // Nombre vacío
            'phone' => '12345', // Solo 5 dígitos
        ];

        $response = $this->postJson('/api/prospects', $payload);

        // Verificamos código 422 y que los campos fallaron
        $response->assertStatus(422)
                ->assertJsonValidationErrors(['name', 'phone']);
    }

    public function test_falla_si_el_telefono_ya_esta_registrado(): void
    {
        // 1. Creamos un prospecto previo en la base de datos de prueba
        Prospect::create([
            'name' => 'Usuario Existente',
            'phone' => '9998887776'
        ]);

        // 2. Intentamos registrar otro con el mismo teléfono
        $payload = [
            'name' => 'Nuevo Usuario',
            'phone' => '9998887776', 
        ];

        $response = $this->postJson('/api/prospects', $payload);

        // Verificamos que falla específicamente en el campo phone
        $response->assertStatus(422)
                ->assertJsonValidationErrors(['phone']);
    }
}
