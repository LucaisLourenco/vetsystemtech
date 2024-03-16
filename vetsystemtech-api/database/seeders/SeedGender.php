<?php

namespace Database\Seeders;

use App\Enum\Gender\EnumGenders;
use App\Models\Gender\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedGender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (EnumGenders::getArray() as $gender) {
            if ($gender instanceof Gender) {
                $gender->insertIfDoesNotExist();
            }
        }
    }
}
