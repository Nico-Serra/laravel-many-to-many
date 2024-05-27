<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['Html', 'Css', 'Scss', 'Vite', 'Npm', 'Laravel', 'Vue', 'Js'];

        foreach ($technologies as $tech) {
            $newTech = new Technology();
            $newTech->name = $tech;
            $newTech->slug = Str::slug($newTech->name, '-');
            $newTech->save();
        }
    }
}
