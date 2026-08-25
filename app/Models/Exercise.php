<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Exercise extends Model
{
    protected $fillable = [
        'category_slug',
        'title',
        'video',
        'duration',
    ];
}
