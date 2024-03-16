<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SeedUserLogin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = (new User())->fill([
            'name' => 'Lucas Lourenço',
            'username' => 'lucas.lourenco',
            'cpf' => '09286681933',
            'role_id' => 1,
            'gender_id' => 1,
            'email' => 'luccaas.lourenco@gmail.com',
            'birth' => '2001-02-03',
            'password' => Hash::make('senha@1234'),
            'active' => 1
        ]);

        $user->insertIfDoesNotExist();
    }
}
