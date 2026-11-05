<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('assistance_requests', function (Blueprint $table) {
            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('assistance_requests', 'tracking_code')) {
                $table->string('tracking_code')->nullable()->after('id');
                $table->unique('tracking_code', 'assistance_requests_tracking_code_unique');
            }
            if (!Schema::hasColumn('assistance_requests', 'jenis')) {
                $table->string('jenis')->nullable()->after('tracking_code'); // jenis bantuan
            }
            if (!Schema::hasColumn('assistance_requests', 'urgency')) {
                $table->string('urgency')->nullable()->after('jenis'); // level urgensi
            }
            if (!Schema::hasColumn('assistance_requests', 'status')) {
                $table->string('status')->default('baru')->after('urgency');
            }
        });

        // Backfill dari kolom lama bila ada (abaikan jika kolom lama tidak ada)
        try {
            // tracking_code <- kode
            DB::statement("
                UPDATE assistance_requests
                SET tracking_code = COALESCE(tracking_code, kode)
                WHERE (tracking_code IS NULL OR tracking_code = '')
                AND EXISTS (
                    SELECT 1 FROM information_schema.COLUMNS
                    WHERE TABLE_SCHEMA = DATABASE()
                      AND TABLE_NAME = 'assistance_requests'
                      AND COLUMN_NAME = 'kode'
                )
            ");

            // jenis <- kategori
            DB::statement("
                UPDATE assistance_requests
                SET jenis = COALESCE(jenis, kategori)
                WHERE (jenis IS NULL OR jenis = '')
                AND EXISTS (
                    SELECT 1 FROM information_schema.COLUMNS
                    WHERE TABLE_SCHEMA = DATABASE()
                      AND TABLE_NAME = 'assistance_requests'
                      AND COLUMN_NAME = 'kategori'
                )
            ");

            // urgency <- severity
            DB::statement("
                UPDATE assistance_requests
                SET urgency = COALESCE(urgency, severity)
                WHERE (urgency IS NULL OR urgency = '')
                AND EXISTS (
                    SELECT 1 FROM information_schema.COLUMNS
                    WHERE TABLE_SCHEMA = DATABASE()
                      AND TABLE_NAME = 'assistance_requests'
                      AND COLUMN_NAME = 'severity'
                )
            ");
        } catch (\Throwable $e) {
            // Diamkan saja agar migration tidak gagal jika metadata tidak tersedia
        }
    }

    public function down(): void
    {
        // Rollback: hapus kolom yang kita tambahkan (opsional)
        Schema::table('assistance_requests', function (Blueprint $table) {
            if (Schema::hasColumn('assistance_requests', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('assistance_requests', 'urgency')) {
                $table->dropColumn('urgency');
            }
            if (Schema::hasColumn('assistance_requests', 'jenis')) {
                $table->dropColumn('jenis');
            }
            if (Schema::hasColumn('assistance_requests', 'tracking_code')) {
                // drop unique index kalau ada
                if (Schema::hasColumn('assistance_requests', 'tracking_code')) {
                    // index name sesuai yang kita buat di up()
                    $table->dropUnique('assistance_requests_tracking_code_unique');
                }
                $table->dropColumn('tracking_code');
            }
        });
    }
};
