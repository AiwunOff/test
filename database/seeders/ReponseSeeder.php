<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reponses')->insert([
            'reponse' => 'C’est pénible mais on doit faire avec',
            'is_correct' => 0,
            'question_id' => 1,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Ce n’est pas grave, c’est affectueux ou c’est de la drague',
            'is_correct' => 0,
            'question_id' => 1,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Ce sont en fait des agissements sexistes, c’est interdit par la loi',
            'is_correct' => 1,
            'question_id' => 1,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'C’est affectueux, sans gravité',
            'is_correct' => 0,
            'question_id' => 2,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Ce sont des agissements sexistes, c’est interdit par la loi',
            'is_correct' => 1,
            'question_id' => 2,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Répétés, ils vont constituer du harcèlement sexuel',
            'is_correct' => 1,
            'question_id' => 2,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Ce n’est pas grave, c’est pour rire',
            'is_correct' => 0,
            'question_id' => 3,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'On n’est pas obligé.e de regarder si cela ne nous plaît pas',
            'is_correct' => 0,
            'question_id' => 3,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'C’est interdit par la loi',
            'is_correct' => 1,
            'question_id' => 3,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Ce n’est pas grave, on s’y habitue',
            'is_correct' => 0,
            'question_id' => 4,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Il suffit d’éviter les collègues pressants correct',
            'is_correct' => 0,
            'question_id' => 4,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'C’est une agression sexuelle, c’est interdit par la loi',
            'is_correct' => 1,
            'question_id' => 4,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Non, ils ne sont pas concernés',
            'is_correct' => 0,
            'question_id' => 5,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'C’est rare et ce n’est pas très grave',
            'is_correct' => 0,
            'question_id' => 5,
        ]);
        DB::table('reponses')->insert([
            'reponse' => 'Oui, plus souvent qu’on ne le pense',
            'is_correct' => 1,
            'question_id' => 5,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '8',
            'is_correct' => 1,
            'question_id' => 6,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '11',
            'is_correct' => 0,
            'question_id' => 6,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '5',
            'is_correct' => 1,
            'question_id' => 6,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '7',
            'is_correct' => 1,
            'question_id' => 7,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '11',
            'is_correct' => 0,
            'question_id' => 7,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '3',
            'is_correct' => 1,
            'question_id' => 7,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '7',
            'is_correct' => 0,
            'question_id' => 8,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '1',
            'is_correct' => 1,
            'question_id' => 8,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '3',
            'is_correct' => 1,
            'question_id' => 8,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '7',
            'is_correct' => 0,
            'question_id' => 9,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '31',
            'is_correct' => 1,
            'question_id' => 9,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '21',
            'is_correct' => 1,
            'question_id' => 9,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '89',
            'is_correct' => 0,
            'question_id' => 10,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '101',
            'is_correct' => 1,
            'question_id' => 10,
        ]);
        DB::table('reponses')->insert([
            'reponse' => '121',
            'is_correct' => 1,
            'question_id' => 10,
        ]);
        
    }
}
