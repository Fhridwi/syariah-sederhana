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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nomor_pembayaran', 50)->unique();
            $table->char('tagihan_id', 36);
            $table->char('santri_id', 36);
            $table->integer('nominal_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran', 50);
            $table->string('penerima', 100);
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['pending', 'terima', 'tolak'])->default('pending');
            $table->text('keterangan_status')->nullable();
            $table->timestamps();
        
            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('cascade');
            $table->foreign('santri_id')->references('id')->on('santris')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
