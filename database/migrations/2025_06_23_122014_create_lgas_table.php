<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('lga', function (Blueprint $table) {
            $table->uniqueid()->nullable();
            $table->integer('lga_id')->nullable();
            $table->string('lga_name', 50)->nullable();
            $table->integer('state_id')->nullable();
            $table->text('lga_description')->nullable();
            $table->string('entered_by_user', 50)->nullable();
            $table->dateTime('date_entered')->nullable();
            $table->string('user_ip_address', 50)->nullable();
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
