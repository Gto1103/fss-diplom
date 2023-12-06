<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($num = 1; $num < 96; $num++) {
            if ($num === 53 || $num === 54 || $num === 55 || $num === 56) {
                $status = 'vip';
            } elseif ($num === 41 || $num === 58 || $num === 74 || $num === 87) {
                $status = 'disabled';
            } else {
                $status = 'standard';
            }

            for ($hall = 1; $hall <= 3; $hall++) {

                DB::table('seats')->insert([
                    'hall_id' => $hall,
                    'number' => 100,
                    'type_seat' => $status,
                ]);
            }
        }
    }
}
