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
            'email' => 'digitalsteppe@gmail.com',
            'password' => bcrypt('P@55W00rD')
        ]);
        $user->assignRole('administrator');

    }
}
