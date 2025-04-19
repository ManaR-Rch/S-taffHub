<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\EmployeProfileController;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\IsRH;


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
  
  Route::middleware('is_rh')->group(function () {
      Route::get('/dashboard/rh', function () {
          return view('dashboard.rh');
      })->name('dashboard.rh');

      Route::resource('personnel', PersonnelController::class);
      Route::resource('jobs', JobController::class);
  });

  Route::get('/dashboard/employe', function () {
      return view('dashboard.employe');
  })->name('dashboard.employe');

  Route::get('/profile', [EmployeProfileController::class, 'show'])->name('employe.profile');
});