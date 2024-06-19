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
            'email' => 'patrick_dahdal@hotmail.com',
            'password' => bcrypt('@pa7887PA')
        ]);
        $user->assignRole('administrator');

    }
}
