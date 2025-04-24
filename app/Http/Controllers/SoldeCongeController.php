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
    public function create(User $user)
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        return view('conges.create-solde', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'solde_annuel' => 'required|integer|min:0',
            'solde_exceptionnel' => 'required|integer|min:0',
            'solde_maladie' => 'required|integer|min:0',
            'commentaire' => 'nullable|string|max:500'
        ]);

        $solde = new SoldeConge($validated);
        $solde->user_id = $user->id;
        $solde->save();

        return redirect()->route('conges.admin-solde')
            ->with('success', 'Le solde de congé a été initialisé avec succès.');
    }
} 