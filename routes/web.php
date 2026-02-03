<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\FotoController;
use Illuminate\Support\Facades\Route;

// Main controller (página principal con filtros y búsqueda)
Route::get('/', [MainController::class, 'index'])->name('main.index');

// Vacacion controller (CRUD ofertas)
Route::resource('vacacion', VacacionController::class);

// Comentario controller
Route::post('comentario', [ComentarioController::class, 'store'])->name('comentario.store');
Route::get('comentario/{comentario}/edit', [ComentarioController::class, 'edit'])->name('comentario.edit');
Route::put('comentario/{comentario}', [ComentarioController::class, 'update'])->name('comentario.update');
Route::delete('comentario/{comentario}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');

// Reserva controller
Route::post('reserva', [ReservaController::class, 'store'])->name('reserva.store');
Route::get('reserva', [ReservaController::class, 'index'])->name('reserva.index');
Route::delete('reserva/{reserva}', [ReservaController::class, 'destroy'])->name('reserva.destroy');

// Foto controller
Route::post('foto', [FotoController::class, 'store'])->name('foto.store');
Route::delete('foto/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');

// Autenticación
Auth::routes(['verify' => true]);
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');