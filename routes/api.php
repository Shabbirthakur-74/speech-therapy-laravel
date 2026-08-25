<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PatientLoginController;
use App\Http\Controllers\Api\AssessmentResultController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\Api\PatientAssessmentResultController;

Route::post('/register', [PatientController::class, 'register']);
Route::post('/patient/login', [PatientLoginController::class, 'store']);
Route::post(
    '/assessment-results',
    [AssessmentResultController::class, 'store']
);
Route::get('/exercise-categories/{slug}/exercises', [ExerciseController::class, 'getByCategory']);

Route::get(
    '/patient/assessment-results',
    [PatientAssessmentResultController::class, 'index']
);

Route::get(
    '/patient/assessment-results/{id}',
    [PatientAssessmentResultController::class, 'show']
);