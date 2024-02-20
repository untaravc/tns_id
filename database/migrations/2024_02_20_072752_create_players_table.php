<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('reg_id')->nullable();
            $table->string('full_name');
            $table->string('first_name')->nullable();
            $table->string('surname_name')->nullable();
            $table->enum('gender', ['F', 'M'])->nullable();
            $table->string('city')->nullable();
            $table->string('city_init')->nullable();
            $table->date('birth_date')->nullable();
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
        Schema::dropIfExists('players');
    }
}
