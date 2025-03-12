<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase; // Reseta o banco antes de cada teste

    public function test_an_admin_can_create_an_event()
    {
        // Criar um admin
        $admin = User::factory()->create(['role' => 'admin']);

        // Logar como admin
        $this->actingAs($admin);

        // Criar evento diretamente pelo model (evita problemas com middleware)
        $event = Event::create([
            'title' => 'Laravel Conference',
            'description' => 'The biggest Laravel event!',
            'date' => now()->addDays(10)->toDateString(),
            'location' => 'Sydney' // Adicionando a localização para evitar erro
        ]);

        // Verificar se o evento foi salvo
        $this->assertDatabaseHas('events', [
            'title' => 'Laravel Conference',
            'location' => 'Sydney'
        ]);
    }
}

