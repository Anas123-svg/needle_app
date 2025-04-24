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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('tax1', 8, 2)->nullable();
            $table->decimal('tax2', 8, 2)->nullable();
            $table->decimal('tax3', 8, 2)->nullable();
            $table->decimal('tax4', 8, 2)->nullable();
            $table->integer('no_of_valid_taxes')->nullable();
            $table->timestamps();

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
