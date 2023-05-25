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
        Schema::table('poverties', function (Blueprint $table) {
            $table->string('sumber_penerangan_utama')->default(0)->nullable();
            $table->string('bab')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('poverties', function (Blueprint $table) {
            $table->dropColumn("sumber_penerangan_utama");
            $table->dropColumn("bab");
        });
    }
};
