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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->uuid('key')->default(DB::raw('(UUID())'));
            $table->unsignedBigInteger('session_id');
            $table->unsignedSmallInteger('session_rating')->nullable();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions');

            $table->index('key');
            $table->index('session_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
