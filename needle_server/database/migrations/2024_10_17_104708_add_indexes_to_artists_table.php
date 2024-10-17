<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->index('email');
            $table->index('nickname');
            $table->index('studio_name');
        });
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->dropIndex(['nickname']);
            $table->dropIndex(['studio_name']);
        });
    }
};
