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
            $table->string('artist_name');
            $table->string('artist_email')->unique();
            $table->string('studio_name');
            $table->string('studio_address');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('password');
            $table->text('invoice_note')->nullable();
            $table->boolean('is_premium_user')->default(false);
            $table->boolean('free_trial')->default(false);
            $table->string('profile_image')->nullable();
            $table->string('currency')->default('USD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
