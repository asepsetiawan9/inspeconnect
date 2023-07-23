<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('nik')->nullable();
            $table->string('role')->nullable()->default('admin');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telp')->default(0)->nullable();
            $table->string('tempat')->nullable();
            $table->text('address')->nullable();
            $table->string('datebirth')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->integer('status')->nullable();
            $table->integer('opd_id')->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
