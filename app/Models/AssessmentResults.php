<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentResults extends Model
{
    protected $fillable = [
        'patient_id',
        'session_id',
        'assessment_type',
        'result_data',
    ];

    protected $casts = [
        'result_data' => 'array',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}