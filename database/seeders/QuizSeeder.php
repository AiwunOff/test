<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('quizzes')->insert([
            'titre' => 'Bienvenue dans cette formation en ligne',
            'module_id' => '1',
        ]);
        DB::table('quizzes')->insert([
            'titre' => 'De quoi s\'agit-il ?',
            'module_id' => '2',
        ]);
        DB::table('quizzes')->insert([
            'titre' => 'Pourquoi ces comportements sexistes demeurent-ils ?',
            'module_id' => '3',
        ]);
        DB::table('quizzes')->insert([
            'titre' => 'Quelles sont les possibilités de réaction ?',
            'module_id' => '4',
        ]);
        DB::table('quizzes')->insert([
            'titre' => 'Rôle de l\'institution d\'enseignement',
            'module_id' => '5',
        ]);
        DB::table('quizzes')->insert([
            'titre' => 'Comment réagir aux violences dans les relations avec des intervenants extérieurs ?',
            'module_id' => '6',
        ]);
    }
}
