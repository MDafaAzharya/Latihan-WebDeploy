<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pengajuan_skk', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('tingkat');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

    }
};
