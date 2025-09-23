<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('clearancereq', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('address');
            $table->date('dateofbirth');
            $table->string('placeofbirth');
            $table->string('civil_status');
            $table->enum('gender', ['male', 'female']);
            $table->text('purpose');
            $table->date('pickup_date')->nullable();
            $table->string('tracking_code')->unique();
            $table->enum('status', ['pending', 'processing', 'ready to pick up', 'released'])->default('pending');
            $table->dateTime('requested_date')->default(now()); // 🆕 Date of Request (Auto-set to current timestamp)
            $table->dateTime('released_date')->nullable(); // New column for release date
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clearancereq');
    }
};
