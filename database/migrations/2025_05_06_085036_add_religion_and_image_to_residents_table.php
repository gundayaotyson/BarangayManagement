<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('residents', function (Blueprint $table) {
        $table->string('religion')->nullable()->after('Citizenship'); // Add religion
        $table->string('image')->nullable()->after('religion'); // Add image
    });
}

public function down()
{
    Schema::table('residents', function (Blueprint $table) {
        $table->dropColumn('religion');
        $table->dropColumn('image');
    });
}

};
