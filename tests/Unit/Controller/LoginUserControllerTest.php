<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\LoginUserController;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginUserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_login()
    {
        $this->assertGuest();
        $user = factory(User::class)->make();
        $data = [
            'email' => $user->email,
            'password' => $user->password,
        ];
        $this->actingAs($user)
            ->post('/postLogin', $data);
        $this->assertAuthenticatedAs($user);
    }
}
