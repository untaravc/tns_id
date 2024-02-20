<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id');
            $table->integer('player_name');
            $table->string('player_number');
            $table->string('competition_id');
            $table->string('competition_name');
            $table->string('competition_category_code');
            $table->integer('point');
            $table->boolean('is_cut_off')->default(0);
            $table->integer('user_id');
            $table->dateTime('date');
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
        Schema::dropIfExists('points');
    }
}
