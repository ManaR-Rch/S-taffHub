<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Mail\EmployeeWelcomeMail;
use Illuminate\Support\Facades\Log;
use App\Mail\NouveauMembreMail;

class PersonnelController extends Controller
{
       /**
     * Afficher la liste du personnel
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $personnel = Personnel::all();
        return view('personnel.index', compact('personnel'));
    }

        /**
     * Afficher le formulaire de création
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('personnel.create');
    }

        /**
     * Enregistrer un nouveau membre du personnel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:personnels',
            'telephone' => 'nullable|string|max:20',
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'salaire_base' => 'required|numeric|min:0',
            'date_embauche' => 'required|date',
            'statut' => 'required|in:actif,inactif',
        ]);

        // Créer le membre du personnel
        $personnel = Personnel::create($validated);

        // Générer un mot de passe aléatoire
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

        // Créer l'utilisateur associé
        User::create([
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role' => 'employe'
        ]);

        // Envoyer l'email avec les identifiants
        Mail::to($validated['email'])->send(new NouveauMembreMail([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => $password
        ]));

        return redirect()->route('personnel.index')
            ->with('success', 'Membre du personnel créé avec succès. Un email a été envoyé avec les identifiants.');
    }


       /**
     * Afficher le formulaire d'édition
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\View\View
     */
    public function edit(Personnel $personnel)
    {
        return view('personnel.edit', compact('personnel'));
    }
  
} 