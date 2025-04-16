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
        Schema::create('santris', function (Blueprint $table) {
            $table->uuid('id')->primary();;
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->text('alamat')->nullable();
            $table->string('program')->nullable(); 
            $table->string('angkatan')->nullable(); 
            $table->string('sekolah_formal')->nullable();
            $table->string('madrasah_diniyah')->nullable();
            $table->string('telepon_orang_tua')->nullable();
            $table->string('foto')->nullable(); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
