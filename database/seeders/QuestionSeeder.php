<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'question' => 'Appeler de façon répétée sa collègue « ma jolie », « la miss », « ma chérie », « ma poulette » :',
            'type' => 'radio',
            'ordre' => 1,
            'quiz_id' => 1,
        ]);
        DB::table('questions')->insert([
            'question' => 'Faire des commentaires sexuels envers une/des collègue/s : (Plusieurs réponses possibles)',
            'type' => 'checkbox',
            'ordre' => 2,
            'quiz_id' => 1,
        ]);
        DB::table('questions')->insert([
            'question' => 'Partager ou afficher des images pornographiques :',
            'type' => 'radio',
            'ordre' => 3,
            'quiz_id' => 1,
        ]);
        DB::table('questions')->insert([
            'question' => 'Embrasser un.e collègue contre son gré :',
            'type' => 'radio',
            'ordre' => 4,
            'quiz_id' => 1,
        ]);
        DB::table('questions')->insert([
            'question' => 'Le harcèlement sexuel et les agissements sexistes touchent-ils aussi les hommes ?',
            'type' => 'radio',
            'ordre' => 5,
            'quiz_id' => 1,
        ]);
        DB::table('questions')->insert([
            'question' => 'Quels chiffres sont plus petits que 10 ?',
            'type' => 'checkbox',
            'ordre' => 1,
            'quiz_id' => 2,
        ]);
        DB::table('questions')->insert([
            'question' => 'Quels chiffres sont plus petits que 8 ?',
            'type' => 'checkbox',
            'ordre' => 2,
            'quiz_id' => 2,
        ]);
        DB::table('questions')->insert([
            'question' => 'Quels chiffres sont plus petits que 5 ?',
            'type' => 'checkbox',
            'ordre' => 3,
            'quiz_id' => 2,
        ]);
        DB::table('questions')->insert([
            'question' => 'Quels chiffres sont plus grandq que 20 ?',
            'type' => 'checkbox',
            'ordre' => 4,
            'quiz_id' => 2,
        ]);
        DB::table('questions')->insert([
            'question' => 'Quels chiffres sont plus grandq que 100 ?',
            'type' => 'checkbox',
            'ordre' => 5,
            'quiz_id' => 2,
        ]);
    }
}


