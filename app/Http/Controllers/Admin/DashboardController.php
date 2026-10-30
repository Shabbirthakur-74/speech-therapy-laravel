<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssessmentResults;
use App\Models\Patient;
use App\Models\PatientLogin;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Total registered patients
        $totalPatientsCount = Patient::count();

        // Patients who logged in today
        $activeTodayCount = Patient::whereHas('logins', function ($query) {
            $query->whereDate('login_at', today());
        })->count();

        return view('admin.dashboard', [
            'totalPatientsCount' => $totalPatientsCount,
            'activeTodayCount' => $activeTodayCount,
        ]);
    }

    /**
     * Permanently delete a patient and all of their data.
     */
    public function destroyPatient($patientId)
    {
        $patient = Patient::findOrFail($patientId);

        DB::transaction(function () use ($patient) {
            AssessmentResults::where('patient_id', $patient->id)->delete();
            PatientLogin::where('patient_id', $patient->id)->delete();
            $patient->delete();
        });

        return response()->json(['success' => true]);
    }

    /**
     * DataTable for all patients.
     */
    public function patientsData()
    {
        $query = Patient::query()
            ->select([
                'id',
                'name',
                'phone',
            ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()

            ->addColumn('report', function (Patient $patient) {
                return '<a
                    href="' . route('admin.patient.report', $patient->id) . '"
                    class="report-button"
                >
                    Show Report
                </a>';
            })

            ->addColumn('delete', function (Patient $patient) {
                return '<button
                    type="button"
                    class="icon-delete"
                    title="Delete patient"
                    aria-label="Delete patient"
                    data-kind="patient"
                    data-id="' . e($patient->id) . '"
                    data-name="' . e($patient->name) . '"
                    data-url="' . route('admin.patient.destroy', $patient->id) . '"
                >
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </button>';
            })
            ->rawColumns(['report', 'delete'])

            ->make(true);
    }

    /**
     * DataTable for patients who logged in today.
     */
    public function activePatientsData()
    {
        $query = DB::table('patient_logins')
            ->join(
                'patients',
                'patients.id',
                '=',
                'patient_logins.patient_id'
            )
            ->whereDate('patient_logins.login_at', today())
            ->select(
                'patients.id',
                'patients.name',
                'patients.phone',
                DB::raw('MAX(patient_logins.login_at) as last_login')
            )
            ->groupBy(
                'patients.id',
                'patients.name',
                'patients.phone'
            );

            return DataTables::query($query)
                ->addIndexColumn()
                ->editColumn('last_login', function ($patient) {
                    return \Carbon\Carbon::parse($patient->last_login)
                        ->format('d M Y, h:i A');
                })
                ->make(true);
    }
}
