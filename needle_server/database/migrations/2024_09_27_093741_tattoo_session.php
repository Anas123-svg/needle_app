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
        Schema::create('tattoo_session', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('session_type');
            $table->decimal('session_cost', 8, 2)->nullable();
            $table->time('timer')->nullable();
            $table->decimal('actual_rate', 8, 2)->nullable();
            $table->decimal('taxes', 8, 2)->nullable();
            $table->decimal('total_rate', 8, 2);
            $table->string('end_session_image')->nullable();
            $table->text('end_session_note')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
