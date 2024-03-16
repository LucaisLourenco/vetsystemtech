<?php

namespace Database\Seeders;

use App\Enum\Role\EnumRoles;
use App\Models\Role\Role;
use Illuminate\Database\Seeder;

class SeedRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (EnumRoles::getArray() as $role) {
            if ($role instanceof Role) {
                $role->insertIfDoesNotExist();
            }
        }
    }
}
