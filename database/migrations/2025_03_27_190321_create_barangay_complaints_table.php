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
        Schema::create('barangay_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('complaint');
            $table->string('respondent');
            $table->string('victim')->nullable();
            $table->date('date');
            $table->string('location');
            $table->text('details');
            $table->enum('status', ['Active Case', 'Settled Case', 'Scheduled Case'])->default('Active Case');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangay_complaints');
    }
};
