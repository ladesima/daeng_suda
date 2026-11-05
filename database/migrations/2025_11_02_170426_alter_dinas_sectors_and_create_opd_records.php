<?php

// database/migrations/2025_10_23_100000_alter_dinas_sectors_and_create_opd_records.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('dinas_sectors', function (Blueprint $t) {
      if (!Schema::hasColumn('dinas_sectors','nama')) $t->string('nama')->after('id');
      if (!Schema::hasColumn('dinas_sectors','slug')) $t->string('slug')->unique()->after('nama');
      if (!Schema::hasColumn('dinas_sectors','group_key')) $t->string('group_key')->nullable()->after('slug'); // inti_sda, perencanaan, sosial_sdm, pemanfaatan, lain
      if (!Schema::hasColumn('dinas_sectors','icon')) $t->string('icon', 32)->nullable()->after('group_key');
      if (!Schema::hasColumn('dinas_sectors','summary')) $t->string('summary', 1000)->nullable()->after('icon');
      if (!Schema::hasColumn('dinas_sectors','form_schema')) $t->json('form_schema')->nullable()->after('summary');
      if (!Schema::hasColumn('dinas_sectors','display_order')) $t->integer('display_order')->nullable()->after('form_schema');
      if (!Schema::hasColumn('dinas_sectors','is_active')) $t->boolean('is_active')->default(true)->after('display_order');
    });

    Schema::create('opd_records', function (Blueprint $t) {
      $t->id();
      $t->foreignId('dinas_sector_id')->constrained('dinas_sectors')->cascadeOnDelete();
      $t->foreignId('village_id')->nullable()->constrained('villages')->nullOnDelete();
      $t->string('kecamatan')->nullable();
      $t->year('periode_tahun')->nullable();
      $t->date('tanggal')->nullable();
      $t->json('payload');      // data sesuai form_schema
      $t->json('lampiran')->nullable(); // paths
      $t->string('status')->default('draft'); // draft|valid|arsip
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('opd_records');
    // (kolom tambahan tidak perlu di-drop satu2)
  }
};
