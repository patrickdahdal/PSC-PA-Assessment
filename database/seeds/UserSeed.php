<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Dmytro (admin)',
            'email' => 'patrickdahdal8008@gmail.com',
            'password' => bcrypt('Patrick12345@')
        ]);
        $user->assignRole('administrator');

    }
}
