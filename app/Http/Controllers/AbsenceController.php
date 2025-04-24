<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        $query = Absence::with('user')->latest();

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('motif')) {
            $query->where('motif', $request->motif);
        }
        if ($request->has('date_debut')) {
            $query->where('date_debut', '>=', $request->date_debut);
        }
        if ($request->has('date_fin')) {
            $query->where('date_fin', '<=', $request->date_fin);
        }
        if ($request->has('justifie')) {
            $query->where('justifie', $request->justifie);
        }

        $absences = $query->get();
        $users = User::where('role', 'employe')->get();
        $statistiques = $this->getStatistiques($absences);

        return view('absences.index', compact('absences', 'users', 'statistiques'));
    }

    public function create()
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        $users = User::where('role', 'employe')->get();
        return view('absences.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|in:maladie,accident,retard,autre',
            'description' => 'nullable|string|max:500',
            'justificatif' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'justifie' => 'boolean',
            'commentaire_rh' => 'nullable|string|max:500'
        ]);

        if ($request->hasFile('justificatif')) {
            $validated['justificatif'] = $request->file('justificatif')->store('justificatifs', 'public');
        }

        Absence::create($validated);

        return redirect()->route('absences.index')
            ->with('success', 'L\'absence a été enregistrée avec succès.');
    }

    public function show(Absence $absence)
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        return view('absences.show', compact('absence'));
    }

    public function update(Request $request, Absence $absence)
    {
        if (!auth()->user()->isRH()) {
            return redirect()->route('dashboard.employe')->with('error', 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'justifie' => 'boolean',
            'commentaire_rh' => 'nullable|string|max:500'
        ]);

        $absence->update($validated);

        return redirect()->route('absences.index')
            ->with('success', 'L\'absence a été mise à jour avec succès.');
    }

    private function getStatistiques($absences)
    {
        $totalAbsences = $absences->count();
        $totalJoursAbsence = $absences->sum('duree');
        $absencesParEmploye = $absences->groupBy('user_id')->map(function ($absences) {
            return [
                'count' => $absences->count(),
                'jours' => $absences->sum('duree')
            ];
        });

        return [
            'totalAbsences' => $totalAbsences,
            'totalJoursAbsence' => $totalJoursAbsence,
            'absencesParEmploye' => $absencesParEmploye
        ];
    }
} 