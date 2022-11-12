<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('key')->default(DB::raw('(UUID())'));
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('session_id');
            $table->string('category');
            $table->string('text')->nullable();
            $table->tinyInteger('is_starred')->default(0);
            $table->unsignedInteger('likes')->default(0);
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
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
