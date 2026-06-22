<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {

            // hapus unique lama
            $table->dropUnique('sections_key_unique');

            // unique baru gabungan
            $table->unique(['school_id', 'key']);
        });
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {

            $table->dropUnique(['school_id', 'key']);

            $table->unique('key');
        });
    }
};