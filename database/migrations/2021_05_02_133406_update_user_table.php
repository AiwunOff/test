<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tranche_age', 255);
            $table->string('pays', 255);
            $table->string('ville', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'tranche_age')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('tranche_age');
            });
        }
        if (Schema::hasColumn('users', 'pays')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('pays');
            });
        }
        if (Schema::hasColumn('users', 'ville')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('ville');
            });
        }

    }
}
