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
    Schema::create('emergency_reports', function (Blueprint $table) {
        $table->id();
        $table->string('kode')->unique();              // kode pelacakan
        $table->string('nama');
        $table->string('hp')->index();
        $table->string('email')->nullable();
        $table->string('kecamatan')->nullable();
        $table->string('desa')->nullable();
        $table->string('alamat')->nullable();
        $table->string('kategori');                    // kekeringan|hama|pencemaran|lainnya
        $table->string('severity');                    // rendah|sedang|tinggi|darurat
        $table->dateTime('waktu')->index();
        $table->decimal('lat', 10, 6)->nullable();
        $table->decimal('lng', 10, 6)->nullable();
        $table->text('uraian');
        $table->json('lampiran')->nullable();          // simpan path file
        $table->string('status')->default('baru');     // baru|diproses|selesai
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_reports');
    }
};
