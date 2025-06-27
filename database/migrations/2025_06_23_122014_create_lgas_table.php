<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('lga', function (Blueprint $table) {
            $table->increments('uniqueid');
            $table->integer('lga_id');
            $table->string('lga_name', 50);
            $table->integer('state_id');
            $table->text('lga_description')->nullable();
            $table->string('entered_by_user', 50);
            $table->dateTime('date_entered');
            $table->string('user_ip_address', 50);
            $table->engine = 'InnoDB';
            $table->charset = 'latin1';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lgas');
    }
};
