<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('halls')->insert([
            'name' => 'Зал 1',
            'rows' => 8,
            'cols' => 12,
            'price' => 250,
            'vip_price' => 600,
            'is_open' => true
        ]);

        DB::table('halls')->insert([
            'name' => 'Зал 2',
            'rows' => 8,
            'cols' => 12,
            'price' => 300,
            'vip_price' => 700,
            'is_open' => true
        ]);

        DB::table('halls')->insert([
            'name' => 'Зал 3',
            'rows' => 8,
            'cols' => 12,
            'price' => 400,
            'vip_price' => 800,
            'is_open' => true
        ]);

    }
}
