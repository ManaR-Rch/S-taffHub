<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect()->intended(
                auth()->user()->isRH() ? '/dashboard/rh' : '/dashboard/employe'
            );
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        \Log::info('Tentative de connexion avec : ' . $credentials['email']);
        \Log::info('Données reçues : ' . json_encode($credentials));

        $user = User::where('email', $credentials['email'])->first();
        \Log::info('Utilisateur trouvé : ' . ($user ? 'oui' : 'non'));

        if ($user) {
            \Log::info('Hash du mot de passe stocké : ' . $user->password);
            \Log::info('Hash du mot de passe fourni : ' . Hash::make($credentials['password']));
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            \Log::info('Connexion réussie pour : ' . $credentials['email'] . ' avec le rôle : ' . auth()->user()->role);
            
            return redirect()->intended(
                auth()->user()->isRH() ? '/dashboard/rh' : '/dashboard/employe'
            );
        }

        \Log::info('Échec de connexion pour : ' . $credentials['email']);

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


