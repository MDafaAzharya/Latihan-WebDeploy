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
        Schema::create('pengajuan_skk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('tingkat');
            $table->string('penguji')->nullable();
            $table->date('tanggal_pengajuan')->nullable(); 
            $table->string('sertifikat')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_skk');
    }
};
