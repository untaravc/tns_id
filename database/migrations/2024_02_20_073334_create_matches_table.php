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
            $table->string('competition_name');
            $table->string('competition_category_code');
            $table->integer('home_first_player_id');
            $table->string('home_first_player_name');
            $table->integer('home_second_player_id')->nullable();
            $table->string('home_second_player_name')->nullable();
            $table->integer('home_final_score');
            $table->integer('away_first_player_id');
            $table->string('away_first_player_name');
            $table->integer('away_second_player_id')->nullable();
            $table->string('away_second_player_name')->nullable();
            $table->integer('away_final_score');
            $table->enum('winner', ['home', 'away'])->nullable();
            $table->date('date')->nullable();
            $table->integer('user_id');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
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
