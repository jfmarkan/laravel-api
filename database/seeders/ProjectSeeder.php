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
        $languages=['html','JavaScript','Vue.js','Vue + Vite','php','Laravel','CSS'];

        for ($i=0; $i < 100; $i++) { 
            $newProject = new Project();
            $newProject->title = ucfirst($faker->unique()->words(3, true));
            $newProject->language = $faker->randomElement($languages);
            $newProject->date = $faker->date();
            $newProject->repo = Str::of("$newProject->title ". $newProject->language)->slug('-');
            $newProject->save();
        }
    }
}
