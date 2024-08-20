<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->string('nickname')->nullable();
            $table->string('email')->unique();
            $table->string('studio_name');
            $table->string('studio_address');
            $table->string('studio_phone_number');
            $table->string('time_zone');
            $table->string('webpage')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook_page')->nullable();
            $table->string('tax_number_1')->nullable();
            $table->string('tax_number_2')->nullable();
            $table->string('password');
            $table->text('invoice_note')->nullable();
            $table->decimal('tattoo_rate', 8, 2)->nullable();
            $table->decimal('consultation_rate', 8, 2)->nullable();
            $table->decimal('drawing_rate', 8, 2)->nullable();
            $table->string('wifi_qr_code_path')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artists');
    }
}
