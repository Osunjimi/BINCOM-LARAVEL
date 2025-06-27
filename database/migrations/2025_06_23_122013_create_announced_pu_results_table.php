<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('announced_pu_results', function (Blueprint $table) {
        $table->id();
        $table->string('polling_unit_uniqueid');
        $table->string('party_abbreviation');
        $table->integer('party_score');
        $table->string('entered_by_user');
        $table->dateTime('date_entered');
        $table->string('user_ip_address');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announced_pu_results');
    }
};
