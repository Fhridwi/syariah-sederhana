<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Run: php artisan make:migration create_sekolah_formals_table --create=sekolah_formals

public function up()
{
    Schema::create('sekolahs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_sekolah');
        $table->text('alamat');
        $table->string('jenjang'); // SLTA SLTP PERGURUAN TINGGI
         $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
