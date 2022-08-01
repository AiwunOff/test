<?php

namespace Database\Seeders;

use App\Models\formation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formations')->insert([
            'titre' => 'Sexisme et harcèlement sexuel',
            'description' => 'Ceci est une formation sur le sexisme et harcèlement sexuel',
            'ordre' => 1,
        ]);

        DB::table('formations')->insert([
            'titre' => 'Droit des femmes',
            'description' => 'Ceci est une formation sur le droit des femmes',
            'ordre' => 2,
        ]);

        DB::table('formations')->insert([
            'titre' => 'Discrimination envers les femmes',
            'description' => 'Ceci est une formation sur les discrimination envers les femmes',
            'ordre' => 3,
        ]);

        DB::table('formations')->insert([
            'titre' => 'Sexisme et harcèlement sexuel suite',
            'description' => 'Ceci est la suite de la formation sur le sexisme et harcèlement sexuel',
            'ordre' => 4,
        ]);
        
    }
}
