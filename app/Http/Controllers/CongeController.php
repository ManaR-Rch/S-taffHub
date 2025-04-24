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


    }
} 