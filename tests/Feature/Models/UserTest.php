<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

     /**
     * Teste create method
     *
     * @group user
     * @return void
     */
    public function testUserControllerStore()
    {        
        $response = User::create([
            'name' => 'User test',
            'email' => 'testdev@dev.com.br'
        ]);

        $this->assertEquals($response->name, 'User test');
    }
}

