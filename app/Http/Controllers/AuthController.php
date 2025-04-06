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
}
