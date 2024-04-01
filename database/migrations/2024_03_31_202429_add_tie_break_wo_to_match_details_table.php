<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTieBreakWoToMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_details', function (Blueprint $table) {
            $table->boolean('is_walkover')->nullable()->default(0);
            $table->boolean('is_home_walkover')->nullable()->default(0);
            $table->boolean('is_away_walkover')->nullable()->default(0);
            $table->boolean('is_first_tie_break')->nullable()->default(0);
            $table->integer('first_home_tie_break_points')->nullable();
            $table->integer('first_away_tie_break_points')->nullable();
            $table->boolean('is_second_tie_break')->nullable()->default(0);
            $table->integer('second_home_tie_break_points')->nullable();
            $table->integer('second_away_tie_break_points')->nullable();
            $table->boolean('is_third_tie_break')->nullable()->default(0);
            $table->integer('third_home_tie_break_points')->nullable();
            $table->integer('third_away_tie_break_points')->nullable();
            $table->boolean('is_fourth_tie_break')->nullable()->default(0);
            $table->integer('fourth_home_tie_break_points')->nullable();
            $table->integer('fourth_away_tie_break_points')->nullable();
            $table->boolean('is_fifth_tie_break')->nullable()->default(0);
            $table->integer('fifth_home_tie_break_points')->nullable();
            $table->integer('fifth_away_tie_break_points')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_details', function (Blueprint $table) {
            $table->dropColumn('is_walkover');
            $table->dropColumn('is_home_walkover');
            $table->dropColumn('is_away_walkover');
            $table->dropColumn('is_first_tie_break');
            $table->dropColumn('first_home_tie_break_points');
            $table->dropColumn('first_away_tie_break_points');
            $table->dropColumn('is_second_tie_break');
            $table->dropColumn('second_home_tie_break_points');
            $table->dropColumn('second_away_tie_break_points');
            $table->dropColumn('is_third_tie_break');
            $table->dropColumn('third_home_tie_break_points');
            $table->dropColumn('third_away_tie_break_points');
            $table->dropColumn('is_fourth_tie_break');
            $table->dropColumn('fourth_home_tie_break_points');
            $table->dropColumn('fourth_away_tie_break_points');
            $table->dropColumn('is_fifth_tie_break');
            $table->dropColumn('fifth_home_tie_break_points');
            $table->dropColumn('fifth_away_tie_break_points');
        });
    }
}
