<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('key');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('session_id');
            $table->string('category');
            $table->string('text');
            $table->tinyInteger('is_starred');
            $table->unsignedInteger('likes');
            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants');
            $table->foreign('session_id')->references('id')->on('sessions');

            $table->index('key');
            $table->index('category');
            $table->index('participant_id');
            $table->index('session_id');
            $table->index('is_starred');
            $table->index('likes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
