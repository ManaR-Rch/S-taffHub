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

  
} 