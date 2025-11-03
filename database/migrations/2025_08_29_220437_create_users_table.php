<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->datetime('creation_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('creator_user_id')->nullable();
            $table->datetime('last_modification_time')->nullable();
            $table->integer('last_modifier_user_id')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('deleter_user_id')->nullable();
            $table->datetime('deletion_time')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('google_id')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->boolean('status')->default(true);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->datetime('creation_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('creator_user_id')->nullable();
            $table->datetime('last_modification_time')->nullable();
            $table->integer('last_modifier_user_id')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('deleter_user_id')->nullable();
            $table->datetime('deletion_time')->nullable();
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->boolean('used')->default(false);
            $table->primary(['email', 'token']);
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
