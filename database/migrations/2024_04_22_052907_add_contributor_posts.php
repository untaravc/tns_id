<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContributorPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_affiliate')->after('category_id')->nullable();
            $table->string('image_url')->after('category_id')->nullable();
            $table->integer('resource_id')->after('category_id')->nullable();
            $table->string('resource_url')->after('category_id')->nullable();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->after('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('is_affiliate');
            $table->dropColumn('image_url');
            $table->dropColumn('resource_id');
            $table->dropColumn('resource_url');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
