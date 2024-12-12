<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_tweet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained(); //tagtableのid
            $table->foreignId('tweet_id')->constrained(); //twwetstableのid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_tweet');
    }
};
