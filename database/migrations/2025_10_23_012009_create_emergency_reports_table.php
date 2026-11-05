<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('emergency_reports')) {
            Schema::create('emergency_reports', function (Blueprint $table) {
                $table->id();
                // WAJIB: sesuai query di controller/view
                $table->string('tracking_code')->unique(); // dipakai di list/history
                $table->string('nama');                    // pelapor
                $table->string('hp');                      // kontak pelapor
                $table->string('kategori');                // kekeringan/hama/pencemaran/dll
                $table->string('severity');                // level kedaruratan

                // Opsional tapi berguna untuk form detail
                $table->string('email')->nullable();
                $table->string('kecamatan')->nullable();
                $table->string('desa')->nullable();
                $table->string('alamat')->nullable();
                $table->dateTime('waktu')->nullable();     // waktu kejadian
                $table->decimal('lat', 10, 6)->nullable();
                $table->decimal('lng', 10, 6)->nullable();
                $table->text('uraian')->nullable();
                $table->json('lampiran')->nullable();
                $table->string('status')->default('baru');

                $table->timestamps();

                // index yang sering dipakai
                $table->index(['kategori']);
                $table->index(['severity']);
                $table->index(['waktu']);
                $table->index(['desa','kecamatan']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_reports');
    }
};
