<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedGender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['name' => 'Masculino'],
            ['name' => 'Feminino'],
            ['name' => 'Prefiro não responder'],
        ];

        DB::table('genders')->insert($genders);
    }
}
