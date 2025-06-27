<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward', function (Blueprint $table) {
            $table->increments('uniqueid');
            $table->integer('ward_id');
            $table->string('ward_name', 50);
            $table->integer('lga_id');
            $table->text('ward_description')->nullable();
            $table->string('entered_by_user', 50);
            $table->dateTime('date_entered');
            $table->string('user_ip_address', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ward');
    }
}