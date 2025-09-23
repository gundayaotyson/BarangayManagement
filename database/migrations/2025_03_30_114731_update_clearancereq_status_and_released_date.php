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
        Schema::table('clearancereq', function (Blueprint $table) {
            // Modify ENUM values to include all statuses
            $table->enum('status', ['pending', 'processing', 'ready to pick up', 'released'])
                  ->default('pending')
                  ->change();

            // Add requested_date column only if it does not exist
            if (!Schema::hasColumn('clearancereq', 'requested_date')) {
                $table->dateTime('requested_date')->default(now()); // ✅ Auto-set on request creation
            }

            // Add released_date column only if it does not exist
            if (!Schema::hasColumn('clearancereq', 'released_date')) {
                $table->dateTime('released_date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clearancereq', function (Blueprint $table) {
            // Rollback ENUM to original state (if necessary)
            $table->enum('status', ['pending', 'released'])->default('pending')->change();

            // Drop requested_date column
            if (Schema::hasColumn('clearancereq', 'requested_date')) {
                $table->dropColumn('requested_date');
            }

            // Drop released_date column
            if (Schema::hasColumn('clearancereq', 'released_date')) {
                $table->dropColumn('released_date');
            }
        });
    }
};
