<?php

namespace Database\Seeders;

use App\Models\faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        faq::factory()
        ->times(10)
        ->create();
    }
}
