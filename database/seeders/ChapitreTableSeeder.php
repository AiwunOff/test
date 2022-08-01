<?php

namespace Database\Seeders;

use App\Models\chapitre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChapitreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 1,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 1,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 1,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 4,
            'module_id' => 1,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 2,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 2,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 2,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 3,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 3,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 3,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 4,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 4,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 4,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 5,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 5,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 6,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 6,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 6,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 4,
            'module_id' => 6,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 7,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 7,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 7,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 1,
            'module_id' => 8,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 2,
            'module_id' => 8,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 3,
            'module_id' => 8,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 4,
            'module_id' => 8,
        ]);
        DB::table('chapitres')->insert([
            'titre' => $faker->sentence(3, true),
            'fichier_video' => $faker->sentence(3, true),
            'description' => $faker->sentence(6, true),
            'ordre' => 5,
            'module_id' => 8,
        ]);
       

    }
}
