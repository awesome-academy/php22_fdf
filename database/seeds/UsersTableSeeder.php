<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\Models\User::create([
           'name' => 'Manh Hung',
            'email' => 'hung@gmail.com',
            'password' => bcrypt('12345678'),
            'address' => 'Da Nang',
            'phone' => '0905555555',
            'is_admin' => true,
        ]);
    }
}
