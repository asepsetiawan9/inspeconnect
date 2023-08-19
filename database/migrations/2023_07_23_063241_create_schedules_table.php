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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('opd_id')->nullable();
            $table->string('consultant_id')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('about')->nullable();
            $table->string('place')->nullable();
            $table->integer('status')->nullable();
            $table->string('pertemuan')->nullable();
            $table->string('respon_admin')->nullable();
            $table->string('user_id')->nullable();
            $table->string('survey_status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
