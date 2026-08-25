<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
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

            ->rawColumns(['report'])

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
