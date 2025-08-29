<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController; // Importa el UsersController
use App\Models\User;
use App\Http\Controllers\ProfileController;

// Login
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard con lógica condicional para el rol
    Route::get('/dashboard', function () {
        if (Auth::user()->role_id == 2) {
            $users = User::all();
            return view('dashboard.index', compact('users'));
        }
        // Redirige al perfil si no es rol 2
        return redirect()->route('profile.edit');
    })->name('dashboard');

    // Rutas para el CRUD de usuarios (solo para rol 2)
    Route::resource('users', UsersController::class);

    // Rutas para el perfil del usuario (para rol 1 y otros)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});