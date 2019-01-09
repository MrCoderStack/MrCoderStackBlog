<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('parent_id')->default(0);
            $table->integer('target_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->text('content');
            $table->string('os', 50)->nullable();
            $table->string('browser', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('ip', 50)->nullable();
            $table->string('city', 50)->nullable();
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
        Schema::dropIfExists('comments');
    }
}
