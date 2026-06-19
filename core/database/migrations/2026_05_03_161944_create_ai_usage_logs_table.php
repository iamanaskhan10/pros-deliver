<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ai_usage_logs
 *
 * Tracks every AI feature call per user for daily usage limits,
 * cost monitoring, and analytics.
 *
 * Indexed on (user_id, feature, created_at) for fast daily count queries.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_usage_logs', function (Blueprint $table) {
            $table->id();

            // The user who triggered the AI call
            $table->unsignedBigInteger('user_id')->index();

            // Which AI feature was used (matches UsageLimiter::FEATURE_* constants)
            $table->string('feature', 50);

            // Optional JSON metadata (job_id, proposal_id, freelancer_id, etc.)
            $table->json('meta')->nullable();

            $table->timestamps();

            // Composite index for fast daily count queries per user + feature
            $table->index(['user_id', 'feature', 'created_at'], 'ai_usage_user_feature_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_usage_logs');
    }
};
