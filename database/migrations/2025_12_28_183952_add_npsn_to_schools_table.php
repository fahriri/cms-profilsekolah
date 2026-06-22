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
    Schema::table('schools', function (Blueprint $table) {
        // Menambahkan kolom npsn setelah kolom id atau name
        $table->string('npsn', 8)->nullable()->unique()->after('name');
    });
}

public function down(): void
{
    Schema::table('schools', function (Blueprint $table) {
        $table->dropColumn('npsn');
    });
}
};
