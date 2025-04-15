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
       
      \Log::info('Début du seeding de la base de données');

        $rh = User::create([
            'nom' => 'Admin RH',
            'email' => 'manarmarchou6@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'rh',
        ]);

        \Log::info('Utilisateur RH créé avec l\'ID : ' . $rh->id);

        $employe = User::create([
            'nom' => 'Employé Test',
            'email' => 'employe@staffhub.com',
            'password' => Hash::make('password123'),
            'role' => 'employe',
        ]);

        \Log::info('Utilisateur Employé créé : ' . $employe->id);


       
    }    
}
