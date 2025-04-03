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

        $personnel = Personnel::create($validated);

  
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

 
        User::create([
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role' => 'employe'
        ]);

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

       /**
     * Mettre à jour un membre du personnel
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Personnel $personnel)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:personnels,email,' . $personnel->id,
            'telephone' => 'nullable|string|max:20',
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'salaire_base' => 'required|numeric|min:0',
            'date_embauche' => 'required|date',
            'statut' => 'required|in:actif,inactif',
        ]);

        $personnel->update($validated);

        return redirect()->route('personnel.index')
            ->with('success', 'Membre du personnel mis à jour avec succès.');
    }

        /**
     * Supprimer un membre du personnel
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Personnel $personnel)
    {
        $personnel->delete();
        return redirect()->route('personnel.index')
            ->with('success', 'Membre du personnel supprimé avec succès.');
    }

       /**
     * Afficher les détails d'un membre du personnel
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\View\View
     */
    public function show(Personnel $personnel)
    {
        return view('personnel.show', compact('personnel'));
    }

  
} 