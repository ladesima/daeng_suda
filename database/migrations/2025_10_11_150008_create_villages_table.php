<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('villages', function (Blueprint $t) {
            $t->id();
            $t->foreignId('sector_id')->constrained()->cascadeOnDelete();

            // A. Identitas
            $t->string('nama');                   // Nama Desa/Kel
            $t->string('kecamatan')->nullable();
            $t->string('kepala_desa')->nullable();
            $t->string('kontak_person')->nullable();
            $t->decimal('luas_wilayah_ha',12,2)->nullable();
            $t->unsignedBigInteger('jumlah_penduduk')->nullable();
            $t->text('kelompok_umkm')->nullable();

            // B. Aspek SDA (pakai JSON supaya field bisa berkembang)
            $t->json('pertanian')->nullable();
            $t->json('perkebunan')->nullable();
            $t->json('perikanan')->nullable();
            $t->json('peternakan')->nullable();
            $t->json('energi')->nullable();
            $t->json('pertambangan')->nullable();
            $t->json('lingkungan_hidup')->nullable();

            // C. Data pendukung (opsional)
            $t->json('data_pendukung')->nullable();

            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
