<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- was missing, caused fatal error in index()

class PatientAssessmentResultController extends Controller
{
    public function index(Request $request)
    {
        $patientId = $request->patient_id;

        $latestCompleteSessionId = AssessmentResults::where('patient_id', $patientId)
            ->select('session_id', DB::raw('MAX(created_at) as last_created_at'))
            ->groupBy('session_id')
            ->havingRaw('COUNT(DISTINCT assessment_type) = 6')
            ->orderByDesc('last_created_at')
            ->value('session_id');

        if (!$latestCompleteSessionId) {
            return response()->json([
                'success' => true,
                'results' => [],
            ]);
        }

        $results = AssessmentResults::with('patient') // <-- eager load patient details
            ->where('patient_id', $patientId)
            ->where('session_id', $latestCompleteSessionId)
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }

    public function show(Request $request, $id)
    {
        $patientId = $request->patient_id;

        $result = AssessmentResults::with('patient') 
            ->where('id', $id)
            ->where('patient_id', $patientId)
            ->first();

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Assessment result not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'result' => $result,
        ]);
    }
}