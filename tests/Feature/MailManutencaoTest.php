<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use equipac\Models\Bolsista;
use equipac\Models\Usuario;
use equipac\Models\Equipamento;
use equipac\Models\Manutencao;
use Faker\Factory as Faker;

class MailManutencaoTest extends TestCase
{
    use WithoutMiddleware;

    public function testSendMail()
    {
        $faker = Faker::create();
        $usuario = factory(Usuario::class)->create();

        $response = $this->actingAs($usuario, 'usuario')->post('/usuario/equipamento', [
            'patrimonio' => $faker->randomNumber(6),
            'modelo' => $faker->company
        ]);

        $response->assertStatus(302);

        $eqp = $usuario->equipamento;

        $response1 = $this->actingAs($usuario, 'usuario')->post('/usuario/lista-equipamento', [
            'id' => $eqp->last()->id,
        ]);

        $response1->assertStatus(302);

        $bolsista = factory(Bolsista::class)->create();
        $manut = $eqp->last()->manutencao;

        $response2 = $this->actingAs($bolsista, 'bolsista')->post('/bolsista/manutencao', [
            'id' => $manut->last()->id,
            'status' => 2,
            'idb' => $bolsista->id
        ]);

        $response2->assertStatus(302);
    }
}