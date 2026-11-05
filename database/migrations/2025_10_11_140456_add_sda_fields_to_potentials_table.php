<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('potentials', function (Blueprint $t) {
            // A. Identitas
            if (!Schema::hasColumn('potentials','desa'))              $t->string('desa')->nullable()->after('id');
            if (!Schema::hasColumn('potentials','kecamatan'))         $t->string('kecamatan')->nullable();
            if (!Schema::hasColumn('potentials','kepala_desa'))       $t->string('kepala_desa')->nullable();
            if (!Schema::hasColumn('potentials','kontak_person'))     $t->string('kontak_person')->nullable();
            if (!Schema::hasColumn('potentials','luas_wilayah_ha'))   $t->decimal('luas_wilayah_ha',12,2)->nullable();
            if (!Schema::hasColumn('potentials','jumlah_penduduk'))   $t->unsignedBigInteger('jumlah_penduduk')->nullable();
            if (!Schema::hasColumn('potentials','kelompok_umkm'))     $t->text('kelompok_umkm')->nullable();

            // B. per-bidang (pakai JSON agar fleksibel)
            foreach ([
                'pertanian','perkebunan','perikanan','peternakan','energi','pertambangan','lingkungan_hidup'
            ] as $json) {
                if (!Schema::hasColumn('potentials', $json)) {
                    $t->json($json)->nullable();
                }
            }

            // C. Data pendukung (JSON biar bisa nambah poin)
            if (!Schema::hasColumn('potentials','data_pendukung')) $t->json('data_pendukung')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('potentials', function (Blueprint $t) {
            foreach ([
                'desa','kecamatan','kepala_desa','kontak_person','luas_wilayah_ha','jumlah_penduduk','kelompok_umkm',
                'pertanian','perkebunan','perikanan','peternakan','energi','pertambangan','lingkungan_hidup','data_pendukung'
            ] as $col) {
                if (Schema::hasColumn('potentials', $col)) $t->dropColumn($col);
            }
        });
    }
};
