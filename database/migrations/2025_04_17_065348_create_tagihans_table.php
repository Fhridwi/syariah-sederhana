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
    Schema::create('tagihans', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('santri_id')->index(); 
        $table->foreignUuid('jenis_pembayaran_id')->index();
        $table->foreignUuid('tarif_pembayaran_id')->index(); 
        $table->integer('nominal');
        $table->enum('periode', ['bulanan', 'semesteran', 'tahunan']);
        $table->string('bulan_tagihan', 20);
        $table->date('jatuh_tempo');
        $table->enum('status', ['belum', 'lunas'])->default('belum');
        $table->string('tahun_ajaran');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
