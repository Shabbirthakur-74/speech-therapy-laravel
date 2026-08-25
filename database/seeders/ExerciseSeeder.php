<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lip Exercises
        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Lip Clousre While Holding Air',
            'video' => 'videos/lip/lip-01.mp4',
            'duration' => 12,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Lip Clousre With Pressure',
            'video' => 'videos/lip/lip-02.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Lip Opening',
            'video' => 'videos/lip/lip-03.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Lip Pucker',
            'video' => 'videos/lip/lip-04.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Open Mouth and Pucker',
            'video' => 'videos/lip/lip-05.mp4',
            'duration' => 12,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Open Mouth and Smile',
            'video' => 'videos/lip/lip-06.mp4',
            'duration' => 11,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Retracted Smile',
            'video' => 'videos/lip/lip-07.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Retracted Smile with Slightly Open',
            'video' => 'videos/lip/lip-08.mp4',
            'duration' => 11,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Smile and Pucker',
            'video' => 'videos/lip/lip-09.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Upper Lip Wrap',
            'video' => 'videos/lip/lip-10.mp4',
            'duration' => 11,
        ]);

        Exercise::create([
            'category_slug' => 'lip-motor-imitation',
            'title' => 'Lower Lip Wrap',
            'video' => 'videos/lip/lip-11.mp4',
            'duration' => 12,
        ]);

        // Jaw Exercises
        Exercise::create([
            'category_slug' => 'jaw-motor-imitation',
            'title' => 'Opening Jaw With Resistance',
            'video' => 'videos/jaw/jaw-01.mp4',
            'duration' => 13,
        ]);

        Exercise::create([
            'category_slug' => 'jaw-motor-imitation',
            'title' => 'Closing Jaw Against Resistance',
            'video' => 'videos/jaw/jaw-02.mp4',
            'duration' => 18,
        ]);

        Exercise::create([
            'category_slug' => 'jaw-motor-imitation',
            'title' => 'Jaw Side to Side',
            'video' => 'videos/jaw/jaw-03.mp4',
            'duration' => 12,
        ]);

        Exercise::create([
            'category_slug' => 'jaw-motor-imitation',
            'title' => 'Soft Palate ELevation (Yawn)',
            'video' => 'videos/jaw/jaw-04.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'jaw-motor-imitation',
            'title' => 'Soft Palate ELevation (Stretch Yawn)',
            'video' => 'videos/jaw/jaw-05.mp4',
            'duration' => 12,
        ]);

        Exercise::create([
            'category_slug' => 'jaw-motor-imitation',
            'title' => 'Soft Palate ELevation-Swallon',
            'video' => 'videos/jaw/jaw-06.mp4',
            'duration' => 10,
        ]);

        // Tongue Exercises
        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Circle (Right to Left)',
            'video' => 'videos/tongue/tongue-01.mp4',
            'duration' => 12,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Laterlization (Left)',
            'video' => 'videos/tongue/tongue-02.mp4',
            'duration' => 11,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Laterlization (Right)',
            'video' => 'videos/tongue/tongue-03.mp4',
            'duration' => 13,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Laterlization (Left-Right)',
            'video' => 'videos/tongue/tongue-04.mp4',
            'duration' => 15,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Lift',
            'video' => 'videos/tongue/tongue-05.mp4',
            'duration' => 10,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Lift (Difficult)',
            'video' => 'videos/tongue/tongue-06.mp4',
            'duration' => 11,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Sweep (Left)',
            'video' => 'videos/tongue/tongue-07.mp4',
            'duration' => 12,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Sweep (Right)',
            'video' => 'videos/tongue/tongue-08.mp4',
            'duration' => 11,
        ]);

        Exercise::create([
            'category_slug' => 'tongue-motor-imitation',
            'title' => 'Tongue Sweep (Left-Right)',
            'video' => 'videos/tongue/tongue-09.mp4',
            'duration' => 14,
        ]);
    }
}
