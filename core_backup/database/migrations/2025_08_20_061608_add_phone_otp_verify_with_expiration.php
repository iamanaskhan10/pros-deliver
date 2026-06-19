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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('phone_otp_verify')->default(0)->after('email_verified_at')
                ->comment('0 = not verified, 1 = verified');
            $table->string('phone_otp_code', 6)->nullable()->after('phone_otp_verify')
                ->comment('Stores the OTP code for phone verification');
            $table->timestamp('phone_otp_expiration')->nullable()->after('phone_otp_code')
                ->comment('Stores the expiration time for the OTP code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_otp_verify', 'phone_otp_code', 'phone_otp_expiration']);
        });
    }
};
