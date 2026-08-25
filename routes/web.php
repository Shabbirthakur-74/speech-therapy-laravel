<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAssessmentResultController;

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('admin.login.submit');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');
});

Route::middleware('auth:admin')->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Yajra DataTables - All Patients
    Route::get('/admin/dashboard/patients', [DashboardController::class, 'patientsData'])
        ->name('admin.dashboard.patients');

    // Yajra DataTables - Active Today
    Route::get('/admin/dashboard/active-patients', [DashboardController::class, 'activePatientsData'])
        ->name('admin.dashboard.active-patients');

     // Main patient report page
    Route::get(
        '/admin/patients/{patientId}/assessment-results',
        [AdminAssessmentResultController::class, 'patientReport']
    )->name('admin.patient.report');


    // Yajra DataTables AJAX endpoint
    Route::get(
        '/admin/patients/{patientId}/assessment-results/data',
        [AdminAssessmentResultController::class, 'patientSessionsData']
    )->name('admin.patient.sessions.data');


    // Get assessment results for a specific session
    Route::get(
        '/admin/patients/{patientId}/assessment-results/{sessionId}',
        [AdminAssessmentResultController::class, 'sessionResults']
    )->name('admin.patient.session.results');
});