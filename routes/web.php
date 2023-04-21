<?php

use App\Http\Controllers\Dentist\ManageClinicController;
use App\Http\Controllers\DentistAppointmentsController;
use App\Http\Controllers\DentistPatientsController;
use App\Http\Controllers\DentistServicesController;
use App\Http\Controllers\Patient\FindDentistsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpdateDentistScheduleController;
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
    Route::get('appointments', [DentistAppointmentsController::class, 'index'])->name('dentist.appointments');

    Route::post('update-dentist-schedule', UpdateDentistScheduleController::class);

    Route::group(['prefix' => 'patient'], function () {
        Route::get('find-dentists', [FindDentistsController::class, 'index'])->name('patient.find-dentists');
        Route::get('do-find-dentists', [FindDentistsController::class, 'doFindDentists'])->name('patient.do-find-dentists');
        Route::get('view-dentist-profile/{dentist}', [FindDentistsController::class, 'viewDentistProfile'])->name('patient.view-dentist-profile');
        Route::post('view-dentist-availability', [FindDentistsController::class, 'getDentistAvailableSchedules'])->name('patient.view-dentist-availability');
        Route::post('create-appointment', [FindDentistsController::class, 'createAppointment'])->name('patient.create-appointment');
    });

    Route::group(['prefix' => 'dentist'], function () {
        Route::get('my-clinic', [ManageClinicController::class, 'index'])->name('dentist.clinic');
        Route::post('update-services', [ManageClinicController::class, 'updateServices'])->name('dentist.update-services');
    });
});

require __DIR__ . '/auth.php';
