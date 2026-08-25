<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssessmentResults;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminAssessmentResultController extends Controller
{
    public function index()
    {
        $results = AssessmentResults::with('patient')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }

    public function show($id)
    {
        $result = AssessmentResults::with('patient')->find($id);

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

    public function patientReport($patientId)
    {
        $patient = Patient::findOrFail($patientId);

        return view('admin.patient-report', [
            'patient' => $patient,
        ]);
    }

    public function patientSessionsData($patientId)
    {
        Patient::findOrFail($patientId);

        $query = AssessmentResults::where('patient_id', $patientId)
            ->select(
                'session_id',
                DB::raw('MIN(created_at) as session_started_at'),
                DB::raw('COUNT(*) as assessment_count'),
                DB::raw('COUNT(DISTINCT assessment_type) as exercise_count')
            )
            ->groupBy('session_id')
            ->having('exercise_count', '=', 6)
            ->orderByDesc('session_started_at');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('session', function ($row) {
                return 'Session ' . $row->DT_RowIndex;
            })
            ->addColumn('date_time', function ($row) {
                return $row->session_started_at
                    ? date('d M Y, h:i A', strtotime($row->session_started_at))
                    : '—';
            })
            ->addColumn('action', function ($row) use ($patientId) {
                return '<button type="button" class="view-results-button" data-patient="' . e($patientId) . '" data-session="' . e($row->session_id) . '">View Results</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function sessionResults($patientId, $sessionId)
    {
        Patient::findOrFail($patientId);

        $results = AssessmentResults::where('patient_id', $patientId)
            ->where('session_id', $sessionId)
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }
}