<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnswersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [
            1 => 'Y',
            2 => '+',
            3 => 'M',
            4 => '-',
            5 => 'N'
        ];

        foreach ($answers as $number => $answer) {
            DB::table('answers')->insert([
                'answer'     => $answer,
                'number'     => $number,
                'created_at' => Carbon::now()
            ]);
        }
    }
}
