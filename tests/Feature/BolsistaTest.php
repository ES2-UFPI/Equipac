<?php

namespace Tests\Feature;

use equipac\Models\Bolsista;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BolsistaTest extends TestCase
{
    public function testRegister()
    {
        $response = $this->get('/bolsista/register');
        $response->assertStatus(200);
    }

    public function testLogin()
    {

        $Bolsista = factory(Bolsista::class)->create();

        $response = $this->post('/bolsista/login', [
            'email' => $Bolsista->email,
            'password' => 'root1234'
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($Bolsista, 'bolsista');
    }

    /**
     * An invalid Bolsista cannot be logged in.
     *
     * @return void
     */
    public function testPasswordInvalido()
    {
        $Bolsista = factory(Bolsista::class)->create();
        $response = $this->post('/bolsista/login', [
            'email' => $Bolsista->email,
            'password' => 'xxx'
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testLoginInvalido()
    {
        $Bolsista = factory(Bolsista::class)->create();
        $response = $this->post('/bolsista/login', [
            'email' => $Bolsista->email,
            'password' => 'invalid'
        ]);
        $this->assertGuest();
    }

    /**
     * A logged in Bolsista can be logged out.
     *
     * @return void
     */
    public function testLogout()
    {
        $Bolsista = factory(Bolsista::class)->create();
        $response = $this->actingAs($Bolsista)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }
}
