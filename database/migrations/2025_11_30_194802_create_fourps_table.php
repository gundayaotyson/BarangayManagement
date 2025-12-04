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
        Schema::create('fourps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('purok_no');
            $table->string('house_no');
            $table->string('fourps_id');
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fourps');
    }
};
