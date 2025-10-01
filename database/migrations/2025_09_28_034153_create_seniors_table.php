<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seniors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->date('birthday');
            $table->string('osca_id')->unique();
            $table->string('fcap_id')->unique();
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seniors');
    }
};
