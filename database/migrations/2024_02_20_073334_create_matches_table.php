<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->integer('competition_id');
            $table->integer('competition_name');
            $table->integer('competition_category_code');
            $table->integer('home_player_id');
            $table->string('home_player_name');
            $table->string('home_final_score');
            $table->boolean('is_home_win');
            $table->integer('away_player_id');
            $table->string('away_player_name');
            $table->string('away_final_score');
            $table->boolean('is_away_win');
            $table->date('date');
            $table->integer('user_id');
            $table->boolean('status');
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
        Schema::dropIfExists('matches');
    }
}
