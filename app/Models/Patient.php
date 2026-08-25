<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'age',
        'gender',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public function logins(): HasMany
    {
        return $this->hasMany(PatientLogin::class);
    }
}