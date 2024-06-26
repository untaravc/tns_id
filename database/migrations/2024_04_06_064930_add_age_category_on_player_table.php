<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgeCategoryOnPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('player_category_code')->after('birth_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('player_category_code');
        });
    }
}
