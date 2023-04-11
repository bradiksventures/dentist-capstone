<?php

use App\Http\Controllers\DentistPatientsController;
use App\Http\Controllers\DentistServicesController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('patients', [DentistPatientsController::class, 'index'])->name('dentist.patients');
    Route::get('services', [DentistServicesController::class, 'index'])->name('dentist.services');
    Route::get('appointments', [\App\Http\Controllers\DentistAppointmentsController::class, 'index'])->name('dentist.appointments');
});

require __DIR__ . '/auth.php';
