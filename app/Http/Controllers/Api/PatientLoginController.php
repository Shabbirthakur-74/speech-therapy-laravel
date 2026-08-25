<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\PatientLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PatientLoginController extends Controller
{
    public function store(Request $request)
    {
        $validated=$request->validate([
            'patient_id'=>['required','exists:patients,id'],
        ]);

        // Close out any abandoned session (patient left mid-assessment).
        // We never resume it - a fresh "Voice Task" tap always starts
        // a brand new session, per spec.
        PatientLogin::where('patient_id',$validated['patient_id'])
            ->whereNull('ended_at')
            ->get()
            ->each(fn($session) => $session->endSession());

        $login=PatientLogin::create([
            'patient_id'=>$validated['patient_id'],
            'session_id'=>(string)Str::uuid(),
            'login_at'=>now(),
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Therapy session started successfully.',
            'session_id'=>$login->session_id,
            'login_at'=>$login->login_at,
        ],201);
    }
}