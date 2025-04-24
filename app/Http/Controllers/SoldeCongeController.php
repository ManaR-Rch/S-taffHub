<?php

namespace App\Http\Controllers;

use App\Models\SoldeConge;
use App\Models\User;
use Illuminate\Http\Request;

class SoldeCongeController extends Controller
{
    public function show()
    {
        $solde = auth()->user()->soldeConge;
        return view('conges.solde', compact('solde'));
    }

    public function adminIndex()
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        $soldes = SoldeConge::with('user')->get();
        return view('conges.admin-solde', compact('soldes'));
    }

} 