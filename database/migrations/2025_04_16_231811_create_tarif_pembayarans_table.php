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
        Schema::create('tarif_pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('jenis_pembayaran_id')->index();
            $table->string('kelas');
            $table->integer('nominal');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_pembayarans');
    }
};
