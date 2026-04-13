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
        Schema::create('unlocked_influencers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('influencer_id');
            $table->unsignedInteger('credits_used')->default(0);
            
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('influencer_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unique(['client_id', 'influencer_id']); // Ensure a client only unlocks an influencer once
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unlocked_influencers');
    }
};
