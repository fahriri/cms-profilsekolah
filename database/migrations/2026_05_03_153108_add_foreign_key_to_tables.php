<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up()
{
    // MENUS
    Schema::table('menus', function (Blueprint $table) {
        $table->foreign('school_id')
              ->references('id')
              ->on('schools')
              ->onDelete('cascade');
    });

    // SECTIONS
    Schema::table('sections', function (Blueprint $table) {
        $table->foreign('school_id')
              ->references('id')
              ->on('schools')
              ->onDelete('cascade');
    });

    // SETTINGS
    Schema::table('settings', function (Blueprint $table) {
        $table->foreign('school_id')
              ->references('id')
              ->on('schools')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
