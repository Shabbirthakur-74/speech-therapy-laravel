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

        // Row numbers (same as the S.No column), used in the session label.
        $offset = (int) request('start', 0);
        $sessionRow = $offset;
        $actionRow = $offset;

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('session', function ($row) use (&$sessionRow) {
                return 'Session ' . ++$sessionRow;
            })
            ->addColumn('date_time', function ($row) {
                return $row->session_started_at
                    ? date('d M Y, h:i A', strtotime($row->session_started_at))
                    : '—';
            })
            ->addColumn('action', function ($row) use ($patientId, &$actionRow) {
                $actionRow++;

                return '<button type="button" class="view-results-button" data-patient="' . e($patientId) . '" data-session="' . e($row->session_id) . '" data-label="Session ' . $actionRow . '" data-date="' . e($row->session_started_at ? date('d M Y, h:i A', strtotime($row->session_started_at)) : '') . '">View Results</button>';
            })
            ->addColumn('delete', function ($row) use ($patientId, &$actionRow) {
                return '<button
                    type="button"
                    class="icon-delete"
                    title="Delete session"
                    aria-label="Delete session"
                    data-kind="session"
                    data-session="' . e($row->session_id) . '"
                    data-name="Session ' . $actionRow . '"
                    data-url="' . route('admin.patient.session.destroy', [$patientId, $row->session_id]) . '"
                >
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </button>';
            })
            ->rawColumns(['action', 'delete'])
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

    /**
     * Permanently delete every result in one assessment session.
     */
    public function destroySession($patientId, $sessionId)
    {
        Patient::findOrFail($patientId);

        $deleted = AssessmentResults::where('patient_id', $patientId)
            ->where('session_id', $sessionId)
            ->delete();

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Session not found',
            ], 404);
        }

        return response()->json(['success' => true]);
    }}
