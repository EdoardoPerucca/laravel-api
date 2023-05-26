<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['PHP', 'HTML', 'CSS', 'JS'];

        foreach ($technologies as $singletecnology) {
            $newTecnology = new Technology();

            $newTecnology->name = $singletecnology;

            $newTecnology->save();
        }
    }
}
