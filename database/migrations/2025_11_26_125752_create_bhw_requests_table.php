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
        Schema::create('bhw_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained()->onDelete('cascade');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->date('dob');
            $table->integer('age');
            $table->string('gender');
            $table->string('purok_no');
            $table->string('sitio');
            $table->string('service_type');
            $table->string('contact_no');
            $table->string('chief_complaint');
            $table->string('status')->default('pending');
            $table->date('sched_date')->nullable();
            $table->string('phil_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhw_requests');
    }
};
