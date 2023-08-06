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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('desc')->nullable();
            $table->string('photos')->nullable();
            $table->string('user_id')->nullable();
            $table->string('role')->nullable();
            $table->integer('status')->nullable();
            $table->string('pertemuan')->nullable();
            $table->string('kontak')->nullable();
            $table->string('datetime')->nullable();
            $table->string('tempat_bertemu')->nullable();
            $table->string('respon_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
