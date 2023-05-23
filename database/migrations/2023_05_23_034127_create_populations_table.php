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
        Schema::create('populations', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_penduduk');
            $table->integer('jumlah_kk');
            $table->integer('jumlah_laki_laki');
            $table->integer('jumlah_perempuan');
            $table->year('tahun');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('populations');
    }
};
