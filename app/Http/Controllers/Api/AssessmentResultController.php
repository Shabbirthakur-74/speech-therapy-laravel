<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AssessmentResults;
use App\Models\PatientLogin;
use Illuminate\Http\Request;
class AssessmentResultController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'=>['required','integer','exists:patients,id'],
            'session_id'=>['required','uuid'],
            'assessment_type'=>['required','string','max:100'],
            'result_data'=>['required','array'],
        ]);
        $session=PatientLogin::where('session_id',$validated['session_id'])
            ->where('patient_id',$validated['patient_id'])
            ->first();
        if(!$session){
            return response()->json([
                'success'=>false,
                'message'=>'Invalid assessment session.',
            ],404);
        }
        if(!$session->isActive()){
            return response()->json([
                'success'=>false,
                'message'=>'This assessment session has already ended.',
            ],422);
        }
        $alreadyCompleted=AssessmentResults::where(
            'session_id',$session->session_id
        )->where(
            'assessment_type',$validated['assessment_type']
        )->exists();
        if($alreadyCompleted){
            return response()->json([
                'success'=>false,
                'message'=>'This assessment has already been completed for this session.',
            ],422);
        }
        $result=AssessmentResults::create([
            'patient_id'=>$validated['patient_id'],
            'session_id'=>$validated['session_id'],
            'assessment_type'=>$validated['assessment_type'],
            'result_data'=>$validated['result_data'],
        ]);
        $requiredAssessments=[
            'voice_baseline',
            'counting',
            'phonation',
            'resonatory_control',
            'facial_articulation',
            'prosody_reading',
        ];
        $completedAssessments=AssessmentResults::where(
            'session_id',$session->session_id
        )->whereIn(
            'assessment_type',$requiredAssessments
        )->distinct()->pluck('assessment_type');
        $allAssessmentsCompleted=$completedAssessments->count()===count($requiredAssessments);
        if($allAssessmentsCompleted){
            $session->endSession();
        }
        return response()->json([
            'success'=>true,
            'message'=>'Assessment result saved successfully.',
        ],201);
    }
}