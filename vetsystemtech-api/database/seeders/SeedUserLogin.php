<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SeedUserLogin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Lucas Lourenço',
            'username' => 'lucas.lourenco',
            'cpf' => '000.000.000-00',
            'role_id' => 1,
            'gender_id' => 1,
            'email' => 'luccaas.lourenco@gmail.com',
            'birth' => '2001-02-03',
            'password' => Hash::make('lucas123'),
            'active' => 1
        ]);    }
}
