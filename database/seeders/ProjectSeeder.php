<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $type_ids = Type::select('id')->pluck('id')->toArray();
        $type_ids[] = null;

        $technology_ids = Technology::select('id')->pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $project = new Project();
            $project->type_id = Arr::random($type_ids);
            $project->name = $faker->words(3, true);
            $project->project_url = $faker->url();
            // $project->image_url = $faker->imageUrl(250, 250);
            $project->description = $faker->paragraphs(5, true);
            $project->save();

            $project_technologies = [];
            foreach ($technology_ids as $technology_id) {
                if ($faker->boolean()) $project_technologies[] = $technology_id;
            }

            $project->technologies()->attach($project_technologies);
        }
    }
}
