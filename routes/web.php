<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::post('/lead/store', [LeadController::class, 'store'])->name('lead.store');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [LeadController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::group(['prefix' => 'lead'], function () {
        Route::put('/update/status/{id}', [LeadController::class, 'updateStatus'])
            ->name('lead.update.status');

        Route::get('edit/{lead}', [LeadController::class, 'edit'])->name('lead.edit');
        Route::put('update/{lead}', [LeadController::class, 'update'])->name('lead.update');
        Route::delete('update/{lead}', [LeadController::class, 'destroy'])->name('lead.destroy');
    });


});

require __DIR__ . '/auth.php';
