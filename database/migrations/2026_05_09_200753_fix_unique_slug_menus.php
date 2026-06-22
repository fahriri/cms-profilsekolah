<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {

            // hapus unique lama
            $table->dropUnique('menus_slug_unique');

            // unique gabungan
            $table->unique(['school_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {

            $table->dropUnique(['school_id', 'slug']);

            $table->unique('slug');
        });
    }
};