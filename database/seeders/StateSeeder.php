<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $states = [
            ['abbreviation' => 'PR', 'name' => 'Paraná', 'ibge_code' => '41', 'created_at' => $now, 'updated_at' => $now],
            ['abbreviation' => 'SP', 'name' => 'São Paulo', 'ibge_code' => '35', 'created_at' => $now, 'updated_at' => $now],
            ['abbreviation' => 'SC', 'name' => 'Santa Catarina', 'ibge_code' => '42', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('states')->insert($states);
    }
}
