<?php

// database/migrations/2025_11_03_000000_create_opd_records_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('opd_records', function (Blueprint $t) {
            $t->id();
            $t->foreignId('dinas_sector_id')->constrained()->cascadeOnDelete(); // OPD
            $t->foreignId('village_id')->constrained()->cascadeOnDelete();      // Desa (dari Sector)
            $t->unsignedSmallInteger('periode_tahun')->nullable();
            $t->date('tanggal')->nullable();
            $t->json('payload');         // hasil isian mengikuti form_schema OPD
            $t->json('lampiran')->nullable(); // array path file
            $t->string('status', 20)->default('draft'); // draft/valid/published
            $t->timestamps();

            // opsional: batasi 1 record per OPD-Desa-Tahun
            $t->unique(['dinas_sector_id','village_id','periode_tahun'],'uniq_opd_village_year');
        });
    }
    public function down(): void { Schema::dropIfExists('opd_records'); }
};
