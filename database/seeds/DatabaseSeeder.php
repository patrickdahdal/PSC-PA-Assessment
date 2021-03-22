<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin permissions, roles and users
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);

        // Assessment questions, answers and traits
        $this->call(QuestionsSeed::class);
        $this->call(AnswersSeed::class);
        $this->call(TraitsSeed::class);
    }
}
