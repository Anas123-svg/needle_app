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
        Schema::create('portfolio_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('portfolio_image_category_id');
            $table->unsignedBigInteger('customer_id'); // New column
            $table->string('url');
            $table->string('picture_notes')->nullable(); // New column
            $table->date('date')->nullable(); // New column
            $table->decimal('rate', 8, 2)->nullable(); // New column
            $table->decimal('hours', 8, 2)->nullable(); //
            $table->decimal('taxes', 8, 2)->nullable(); //
            $table->boolean('favourite')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('portfolio_image_category_id')->references('id')->on('portfolio_image_categories')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade'); // New foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_images');
    }
};
