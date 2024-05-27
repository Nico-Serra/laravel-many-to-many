<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        
        for ($i=0; $i < 10 ; $i++) { 
           
            $project = new Project();
            $project->name = $faker->words(4, true);
            $project->slug = Str::of($project->name)->slug('-');
            $project->link = 'https://github.com/Nico-Serra';
            $project->cover_image = $faker->imageUrl(400, 200, null, true, $project->name , false, 'png');
            $project->project_date = $faker->dateTimeThisYear('now');
            $project->save();

        }


    }
}
