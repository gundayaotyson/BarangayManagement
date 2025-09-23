<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clearancereq', function ($table) {
            $table->unsignedBigInteger('resident_id')->nullable()->after('fullname');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('clearancereq', function ($table) {
            $table->dropForeign(['resident_id']);
            $table->dropColumn('resident_id');
        });
    }

};
