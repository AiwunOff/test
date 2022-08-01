<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $i = 1;
        DB::table('modules')->insert([
            'titre' => 'Bienvenue dans cette formation en ligne',
            'description' => 'Présentation de la formation',
            'ordre' => $i++,
            'formation_id' => '1',
        ]);
        DB::table('modules')->insert([
            'titre' => 'De quoi s\'agit-il ?',
            'description' => 'Dans ce module, nous allons définir ce que sont des agissements sexistes, du harcèlement sexuel et des aggressions sexuelles, comment nous pouvons les identifier.',
            'ordre' => $i++,
            'formation_id' => '1',
        ]);
        DB::table('modules')->insert([
            'titre' => 'Pourquoi ces comportements sexistes demeurent-ils ?',
            'description' => 'Dans ce module, nous allons examiner les contextes et les origines de ces comportements.',
            'ordre' => $i++,
            'formation_id' => '1',
        ]);
        DB::table('modules')->insert([
            'titre' => 'Quelles sont les possibilités de réaction ?',
            'description' => 'Dans ce module, nous allons passer en revue les possibilités de réaction, les procédures, les rôles des témoins, etc. ',
            'ordre' => $i++,
            'formation_id' => '1',
        ]);
        DB::table('modules')->insert([
            'titre' => 'Rôle de l\'institution d\'enseignement',
            'description' => 'Dans ce module, nous allons examiner les responsabilités et obligations de l\'établissement d\'enseignement.',
            'ordre' => $i++,
            'formation_id' => '1',
        ]);
        DB::table('modules')->insert([
            'titre' => 'Comment réagir aux violences dans les relations avec des intervenants extérieurs ?',
            'description' => 'Dans ce module, nous allons examiner les manières de réagir dans les cas où les auteurs ou les victimes des comportements sexistes sont des intervenants extérieurs à l\'établissement d\'enseignement.',
            'ordre' => $i++,
            'formation_id' => '1',
        ]);

        $i = 1;
        
        DB::table('modules')->insert([
            'titre' => 'Autre module numéro 1',
            'description' => 'Dans ce module, nous allons examiner Autre module numéro 1.',
            'ordre' => $i++,
            'formation_id' => '2',
        ]);
        DB::table('modules')->insert([
            'titre' => 'Autre module numéro 2',
            'description' => 'Dans ce module, nous allons examiner Autre module numéro 2.',
            'ordre' => $i++,
            'formation_id' => '2',
        ]);
        
    }

    
}
