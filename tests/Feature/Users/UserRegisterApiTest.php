<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_register_a_user()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);

        $data = [
            'name'=>'test',
            'email'=>'test@test.com',
            'ID_no'=>'88888',
            'password'=>'12345678',
            'c_password'=>'12345678',
        ];

        $response = $this->post(route('user.register') , $data);

        $response->assertStatus(200);
    }
}
