<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCertificatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificats', function (Blueprint $table) {
            $table->dropColumn('text');
            $table->integer('user_id');
            $table->text('nom');
            $table->text('prenom');
            $table->text('formation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificats', function (Blueprint $table) {
            $table->text('text');
            $table->dropColumn('user_id');
            $table->dropColumn('nom');
            $table->dropColumn('prenom');
            $table->dropColumn('formation');
        });
    }
}
