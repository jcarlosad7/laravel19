<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Apps\User;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function agregar_users()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
