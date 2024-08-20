<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->onDelete('cascade'); // Foreign key to the artists table
            $table->decimal('amount', 10, 2); // Amount earned
            $table->date('date'); // Date of the earning
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('earnings');
    }
}
