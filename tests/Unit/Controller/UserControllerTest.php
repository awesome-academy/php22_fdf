<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\UsersController;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_index_returns_view()
    {
        $controller = new UsersController();
        $view = $controller->index();
        $this->assertEquals('admin.users.index', $view->getName());
        $this->assertArrayHasKey('users', $view->getData());
    }

    public function test_create_returns_view()
    {
        $controller = new UsersController();
        $view = $controller->create();
        $this->assertEquals('admin.users.create', $view->getName());
    }

    public function test_store_user()
    {
        $user= factory(User::class)->create();
        $this->assertInstanceOf(User::class, $user);
        $findUser = User::findOrFail($user->id);
        $this->assertEquals($findUser->name, $user->name);
        $this->assertEquals($findUser->email, $user->email);
        $this->assertEquals($findUser->password, $user->password);
        $this->assertEquals($findUser->address, $user->address);
        $this->assertEquals($findUser->phone, $user->phone);
        $this->assertEquals($findUser->is_admin, $user->is_admin);
    }

    public function test_show_user()
    {
        $controller = new UsersController();
        $view = $controller->show(1);
        $this->assertEquals('admin.users.detail', $view->getName());
        $this->assertArrayHasKey('user', $view->getData());
        $this->assertArrayHasKey('transactions', $view->getData());

    }

    public function test_edit_returns_view()
    {
        $controller = new UsersController();
        $view = $controller->edit(1);
        $this->assertEquals('admin.users.profile', $view->getName());
        $this->assertArrayHasKey('user', $view->getData());
    }

    public function test_update_user()
    {
        $usernew= factory(User::class)->create();
        $data = [
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => '12345678',
            'address' => 'Da Nang',
            'phone' => '0905555555',
            'is_admin' => 0,
        ];
        $this->assertInstanceOf(User::class, $usernew);
        $findUser = User::findOrFail($usernew->id);
        $userUp = $findUser->update($data);
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'is_admin' => $data['is_admin'],
        ]);
    }

    public function test_user_destroy()
    {
        $user = factory(User::class)->create();
        $this->assertInstanceOf(User::class, $user);
        $success = $user->delete();
        $this->assertTrue($success);
        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'address' => $user->address,
            'phone' => $user->phone,
            'is_admin' => $user->is_admin,
        ]);
    }

}
