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
        Schema::create('barangay_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->enum('purok', ['Purok 1', 'Purok 2', 'Purok 3']);
            $table->string('sitio')->nullable(); // Auto-filled based on Purok
            $table->string('category');
            $table->text('description');
            $table->date('start_date');
            $table->date('target_completion_date');
            $table->enum('status', ['Planned', 'Ongoing', 'Completed', 'Delayed', 'Cancelled']);
            $table->decimal('completion_percentage', 5, 2)->default(0);
            $table->decimal('total_budget', 12, 2);
            $table->decimal('funds_utilized', 12, 2)->default(0);
            $table->string('funding_source');
            $table->string('project_lead');
            $table->string('contractor')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangay_projects');
    }
};
