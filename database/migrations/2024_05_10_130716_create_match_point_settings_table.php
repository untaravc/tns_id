<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchPointSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_point_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('competition_code');
            $table->string('match_type_code');
            $table->string('round_code');
            $table->float('point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_point_settings');
    }
}
