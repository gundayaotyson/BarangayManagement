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
        Schema::create('sk_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('purok');
            $table->string('category');
            $table->date('start_date');
            $table->date('target_date');
            $table->decimal('budget', 10, 2);
            $table->string('status')->default('Not Started');
            $table->integer('progress')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_projects');
    }
};
