<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\EmployeProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\IsRH;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\SoldeCongeController;

Route::aliasMiddleware('is_rh', IsRH::class);

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->intended(
            auth()->user()->isRH() ? '/dashboard/rh' : '/dashboard/employe'
        );
    }
    return view('landing');
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::get('/conges/solde', [SoldeCongeController::class, 'show'])->name('conges.solde');
    
    Route::middleware('is_rh')->group(function () {
        Route::get('/dashboard/rh', function () {
            return view('dashboard.rh');
        })->name('dashboard.rh');

        Route::resource('personnel', PersonnelController::class);
        Route::resource('jobs', JobController::class);
        
  
        Route::get('/conges/admin', [CongeController::class, 'adminIndex'])->name('conges.admin');
        Route::put('/conges/{conge}/status', [CongeController::class, 'updateStatus'])->name('conges.update-status');
        
 
        Route::get('/conges/soldes', [SoldeCongeController::class, 'adminIndex'])->name('conges.admin-solde');
        Route::get('/conges/soldes/create/{user}', [SoldeCongeController::class, 'create'])->name('conges.create-solde');
        Route::post('/conges/soldes/{user}', [SoldeCongeController::class, 'store'])->name('conges.store-solde');
        Route::get('/conges/soldes/{solde}/edit', [SoldeCongeController::class, 'edit'])->name('conges.edit-solde');
        Route::put('/conges/soldes/{solde}', [SoldeCongeController::class, 'update'])->name('conges.update-solde');
    });

    Route::get('/dashboard/employe', function () {
        return view('dashboard.employe');
    })->name('dashboard.employe');

    Route::get('/profile', [EmployeProfileController::class, 'show'])->name('employe.profile');
});

Route::get('/test-email', function () {
    try {
       
        $config = config('mail');
        
        \Illuminate\Support\Facades\Mail::raw('Test d\'envoi d\'email avec Gmail', function($message) {
            $message->to('manarmarchou6@gmail.com')
                   ->subject('Test StaffHub - Configuration Gmail');
        });
        
        return response()->json([
            'status' => 'success',
            'message' => 'Email envoyé avec succès !',
            'config' => [
                'driver' => $config['default'],
                'host' => $config['mailers']['smtp']['host'],
                'port' => $config['mailers']['smtp']['port']
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur : ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
