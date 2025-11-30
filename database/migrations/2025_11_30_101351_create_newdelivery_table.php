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
        Schema::create('newdelivery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->unsignedBigInteger('pregnants_id')->nullable();
            $table->string('p_fname');
            $table->string('p_mname');
            $table->string('p_lname');
            $table->integer('age');
            $table->date('birthday');
            $table->string('purok_no');
            $table->string('sitio');
            $table->string('household_no');
            $table->string('placeofbirth');
            $table->string('typeof_birth');
            $table->string('c_fname');
            $table->string('c_mname');
            $table->string('c_lname');
            $table->date('c_birthday');
            $table->time('time');
            $table->string('weight');
            $table->string('height');
            $table->string('gender');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newdelivery');
    }
};
