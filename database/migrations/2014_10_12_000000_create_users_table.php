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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nomor',50);
            $table->string('angkatan',50);
            $table->string('password');
            $table->string('gambar')->nullable();
            $table->string('nta',50)->nullable();
            $table->string('role',20)->nullable();
            $table->string('jenis_kelamin',50)->nullable();
            $table->string('tempat_lahir',50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama',50)->nullable();
            $table->string('alamat',50)->nullable();
            $table->string('provinsi',50)->nullable();
            $table->string('kota',50)->nullable();
            $table->string('kecamatan',50)->nullable();
            $table->string('kode_pos',50)->nullable();
            // $table->string('gambar')->nullable();
            $table->string('sosmed_facebook')->nullable();
            $table->string('sosmed_instagram')->nullable();
            $table->string('sosmed_tiktok')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
