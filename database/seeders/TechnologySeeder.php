<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['label' => 'HTML', 'color' => 'danger'],
            ['label' => 'CSS', 'color' => 'info'],
            ['label' => 'Bootstrap', 'color' => 'primary-subtle'],
            ['label' => 'JavaScript', 'color' => 'warning'],
            ['label' => 'Vue', 'color' => 'success'],
            ['label' => 'SASS', 'color' => 'danger-subtle'],
            ['label' => 'PHP', 'color' => 'primary'],
            ['label' => 'MySQL', 'color' => 'info-subtle'],
            ['label' => 'Laravel', 'color' => 'danger-subtle'],
        ];

        foreach ($technologies as $technology) {
            $new_tech = new Technology();
            $new_tech->label = $technology['label'];
            $new_tech->color = $technology['color'];
            $new_tech->save();
        }
    }
}
