<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class EmployeProfileController extends Controller
{
   /**
     * Afficher le profil de l'employé
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $employe = Personnel::where('email', auth()->user()->email)->firstOrFail();
        return view('employe.profile', compact('employe'));
    }
} 