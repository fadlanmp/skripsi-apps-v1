<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ustads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kitab_id');
            $table->string('name');
            $table->string('jk');
            $table->string('no_kontak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ustads');
    }
};
