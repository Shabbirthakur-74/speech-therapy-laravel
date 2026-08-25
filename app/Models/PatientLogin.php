<?php
namespace App\Models;
use App\Models\AssessmentResults;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PatientLogin extends Model
{
    protected $fillable=[
        'patient_id',
        'session_id',
        'login_at',
        'ended_at',
    ];
    protected $casts=[
        'login_at'=>'datetime',
        'ended_at'=>'datetime',
    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function isActive(): bool
    {
        return $this->ended_at===null;
    }
    public function isEnded(): bool
    {
        return $this->ended_at!==null;
    }
    public function endSession(): void
    {
        if($this->isActive()){
            $this->update([
                'ended_at'=>now(),
            ]);
        }
    }
}