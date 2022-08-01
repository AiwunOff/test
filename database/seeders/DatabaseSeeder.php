<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FormationTableSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(ChapitreTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(ReponseSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
