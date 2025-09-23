<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('Fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('birthday'); // Add birthday field
            $table->string('birthplace'); // Add place of birth
            $table->integer('age')->nullable(); // Age will be calculated dynamically
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated', 'Divorced']);
            $table->string('Citizenship');
            $table->string('contact_number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('household_no');

            // Change purok_no to enum
            $table->enum('purok_no', ['Purok 1', 'Purok 2', 'Purok 3']);
            $table->enum('sitio', ['Sitio Leksab', 'Sitio Taew', 'Sitio Pidlaoan'])->nullable(); // Sitio is nullable and depends on Purok 2

            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('residents');
    }
};
