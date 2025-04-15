<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
     /**
     * Seed the application's database.
     */
    public function run(): void
    {
       

        $rh = User::create([
            'nom' => 'Admin RH',
            'email' => 'manarmarchou6@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'rh',
        ]);



        $employe = User::create([
            'nom' => 'Employé Test',
            'email' => 'employe@staffhub.com',
            'password' => Hash::make('password123'),
            'role' => 'employe',
        ]);

       
    }    
}
