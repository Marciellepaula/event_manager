<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::middleware(['can:isAdmin'])->prefix('admin/events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    Route::middleware(['can:isAdmin'])->prefix('admin')->group(function () {
        Route::get('/', [EventController::class, 'painel'])->name('painel');
    });


    Route::middleware(['can:isAdmin'])->prefix('admin/registration')->group(function () {
        Route::get('/', [EventController::class, 'showregistrations'])->name('events.registration');
    });

    Route::prefix('participant/inscricoes')->group(function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('inscricoes.index');
        Route::post('/{evento}/inscrever', [RegistrationController::class, 'inscrever'])->name('inscricoes.inscrever');
        Route::post('/{evento}/cancelar', [RegistrationController::class, 'cancelar'])->name('inscricoes.cancelar');
    });
});



require __DIR__ . '/auth.php';
Route::any('{url}', function () {
    return response()->view('errors.404', ['error' => 'Not Found'], 404);
})->where('url', '.*');
