<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChapitresTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('chapitres', function (Blueprint $table) {
            $table->string('sous_titres', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('chapitres', 'sous_titres'))
        {
            Schema::table('chapitres', function (Blueprint $table)
            {
                $table->dropColumn('sous_titres');
            });
        }
    }
}
