<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20|unique:patients,phone',
                'address' => 'required|string',
                'age' => 'required|integer|min:1|max:120',
                'gender' => 'required|string|max:50',
            ]);

            $patient = Patient::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Patient registered successfully.',
                'data' => $patient,
            ], 201);

        } catch (ValidationException $e) {

            if (isset($e->errors()['phone'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'This User is already exists.',
                    'errors' => [
                        'phone' => [
                            'This phone number is already registered.'
                        ]
                    ]
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}