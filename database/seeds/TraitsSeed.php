<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TraitsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $traits = [
            1 => ['key' => 'A', 'trait' => 'Attention'],
            2 => ['key' => 'B', 'trait' => 'Emotion'],
            3 => ['key' => 'C', 'trait' => 'Composure'],
            4 => ['key' => 'D', 'trait' => 'Certainty'],
            5 => ['key' => 'E', 'trait' => 'Activity'],
            6 => ['key' => 'F', 'trait' => 'Boldness'],
            7 => ['key' => 'G', 'trait' => 'Responsibility'],
            8 => ['key' => 'H', 'trait' => 'Correct Estimation'],
            9 => ['key' => 'I', 'trait' => 'Empathy'],
            10 => ['key' => 'J', 'trait' => 'Communication']
        ];

        foreach ($traits as $number => $values) {
            DB::table('traits')->insert([
                'key'        => $values['key'],
                'trait'      => $values['trait'],
                'number'     => $number,
                'created_at' => Carbon::now()
            ]);
        }
    }
}
