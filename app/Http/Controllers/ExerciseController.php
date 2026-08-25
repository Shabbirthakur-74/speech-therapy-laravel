<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function getByCategory($slug)
    {
        $exercises = Exercise::where('category_slug', $slug)->get();

        return response()->json($exercises);
    }
}
