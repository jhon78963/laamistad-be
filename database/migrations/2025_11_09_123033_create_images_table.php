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
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->datetime('creation_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('creator_user_id')->nullable();
            $table->datetime('last_modification_time')->nullable();
            $table->uuid('last_modifier_user_id')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->uuid('deleter_user_id')->nullable();
            $table->datetime('deletion_time')->nullable();
            $table->string('name');
            $table->string('path');
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
