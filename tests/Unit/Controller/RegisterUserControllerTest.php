<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\RegisterUserController;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_register()
    {
        $this->assertGuest();
        $user = factory(User::class)->make();
        $data = [
            'email' => $user->email,
            'password' => $user->password,
        ];
        $this->actingAs($user)
            ->post('/postRegister', $data);
        $this->assertAuthenticatedAs($user);
    }
}
