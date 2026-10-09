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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20)->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('backup_email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gender', 30)->nullable();
            $table->string('language', 20)->default('taglish');
            $table->boolean('fun_pet_effects')->default(true);
            $table->string('account_status', 20)->default('active');
            $table->string('data_retention_mode', 20)->default('standard');
            $table->string('retention_protection_source', 40)->nullable();
            $table->timestamp('retention_started_at')->nullable();
            $table->timestamp('retention_ends_at')->nullable();
            $table->timestamp('retention_grace_ends_at')->nullable();
            $table->text('retention_reason')->nullable();
            $table->unsignedBigInteger('retention_set_by')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('phone', 20)->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
