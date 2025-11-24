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
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable();
            $table->string('business_address')->nullable();
            $table->string('res_started_living')->nullable();
            $table->date('cert_use_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clearancereq', function (Blueprint $table) {
            $table->dropColumn(['business_name', 'business_type', 'business_address', 'res_started_living', 'cert_use_date']);
        });
    }
};
