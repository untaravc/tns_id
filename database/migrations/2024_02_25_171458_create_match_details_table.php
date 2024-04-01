<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('first_home_points')->nullable();
            $table->integer('first_away_points')->nullable();
            $table->integer('first_time_minutes')->nullable();

            $table->integer('second_home_points')->nullable();
            $table->integer('second_away_points')->nullable();
            $table->integer('second_time_minutes')->nullable();

            $table->integer('third_home_points')->nullable();
            $table->integer('third_away_points')->nullable();
            $table->integer('third_time_minutes')->nullable();

            $table->integer('fourth_home_points')->nullable();
            $table->integer('fourth_away_points')->nullable();
            $table->integer('fourth_time_minutes')->nullable();

            $table->integer('fifth_home_points')->nullable();
            $table->integer('fifth_away_points')->nullable();
            $table->integer('fifth_time_minutes')->nullable();

            $table->integer('final_home_points')->nullable();
            $table->integer('final_away_points')->nullable();
            $table->integer('final_time_minutes')->nullable();
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
        Schema::dropIfExists('match_details');
    }
}
