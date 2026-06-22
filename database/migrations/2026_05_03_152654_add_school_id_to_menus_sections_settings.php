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
        $table->unsignedBigInteger('school_id')->after('id');
    });

    // SECTIONS
    Schema::table('sections', function (Blueprint $table) {
        $table->unsignedBigInteger('school_id')->after('id');
    });

    // SETTINGS
    Schema::table('settings', function (Blueprint $table) {
        $table->unsignedBigInteger('school_id')->after('id');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus_sections_settings', function (Blueprint $table) {
            //
        });
    }
};
