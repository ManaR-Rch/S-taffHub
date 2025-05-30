<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    
    public function index()
    {
        $conges = auth()->user()->conges()->latest()->get();
        return view('conges.index', compact('conges'));
    }

 
    public function adminIndex(Request $request)
    {
        $query = Conge::with('user')->latest();

        // Filtres
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->has('date_debut')) {
            $query->where('date_debut', '>=', $request->date_debut);
        }
        if ($request->has('date_fin')) {
            $query->where('date_fin', '<=', $request->date_fin);
        }

        $conges = $query->get();
        $users = \App\Models\User::where('role', 'employe')->get();

        return view('conges.admin-index', compact('conges', 'users'));
    }

    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type' => 'required|in:annuel,exceptionnel,sans_solde,maladie,maternite,paternite',
            'motif' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['statut'] = 'en_attente';

        Conge::create($validated);

        return redirect()->route('conges.index')
            ->with('success', 'Votre demande de congé a été soumise avec succès.');
    }

    public function updateStatus(Request $request, Conge $conge)
    {
        if (!auth()->user()->isRH()) {
            return back()->with('error', 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'statut' => 'required|in:accepte,refuse',
            'commentaire_rh' => 'nullable|string|max:500',
        ]);

       
        if ($validated['statut'] === 'accepte') {
            $duree = $conge->date_debut->diffInDays($conge->date_fin) + 1;
            $solde = $conge->user->soldeConge;
            
          
            if ($conge->type === 'annuel' && $solde->solde_annuel < $duree) {
                return back()->with('error', 'Le solde de congés annuels est insuffisant.');
            }
            if ($conge->type === 'exceptionnel' && $solde->solde_exceptionnel < $duree) {
                return back()->with('error', 'Le solde de congés exceptionnels est insuffisant.');
            }
            if ($conge->type === 'maladie' && $solde->solde_maladie < $duree) {
                return back()->with('error', 'Le solde de congés maladie est insuffisant.');
            }

            $solde->updateSolde($conge->type, -$duree);
        }

        $conge->update($validated);

        return back()->with('success', 'Le statut de la demande a été mis à jour.');
    }
} 