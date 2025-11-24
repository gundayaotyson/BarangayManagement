<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('senior_services', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('resident_id'); // FK to residents table
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('dob');
            $table->integer('age');
            $table->string('gender');
            $table->string('house_no');
            $table->string('purok');
            $table->string('sitio')->default('N/A');
            $table->string('oscaId')->unique();

            $table->string('fcapId')->unique();

            // New fields
            $table->enum('status', ['pending', 'processing', 'accept', 'rejected'])->default('pending');
            $table->date('request_date');
            $table->date('accept_date')->nullable();

            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('senior_services');
    }
};
