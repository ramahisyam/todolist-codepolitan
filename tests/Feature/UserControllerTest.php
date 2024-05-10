<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText("Login");
    }

    public function testLoginSuccess() {
        $this->post('/login', [
            "user" => "rama",
            "password" => "rahasia"
        ])->assertRedirect("/")
        ->assertSessionHas("user", "rama");
    }

    public function testLoginValidation() {
        $this->post('/login', [
            "user" => "rama"
        ])
        ->assertSeeText("User or password is required");
    }

    public function testLoginFailed() {
        $this->post('/login', [
            "user" => "rama",
            "password" => "secret"
        ])
        ->assertSeeText("User or Password incorrect");
    }
}
