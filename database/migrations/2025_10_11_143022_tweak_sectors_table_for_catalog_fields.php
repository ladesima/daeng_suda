<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sectors', function (Blueprint $t) {
            if (!Schema::hasColumn('sectors', 'slug')) {
                $t->string('slug')->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('sectors', 'icon')) {
                $t->string('icon')->nullable()->after('slug'); // contoh: 'building'
            }
            if (!Schema::hasColumn('sectors', 'summary')) {
                $t->text('summary')->nullable()->after('icon');
            }
            if (!Schema::hasColumn('sectors', 'display_order')) {
                $t->unsignedInteger('display_order')->default(0)->after('summary');
            }
            if (!Schema::hasColumn('sectors', 'is_active')) {
                $t->boolean('is_active')->default(true)->after('display_order');
            }
            // pastikan timestamps ada
            if (!Schema::hasColumn('sectors','created_at')) {
                $t->timestamps();
            }
        });

        // Optional: pastikan foreign key di potentials -> sectors
        if (Schema::hasTable('potentials') && Schema::hasColumn('potentials','sector_id')) {
            Schema::table('potentials', function (Blueprint $t) {
                // tambahkan index & FK bila belum ada (diamankan try)
                if (!Schema::hasColumn('potentials', 'sector_id')) return;
                // biarkan DB existing; FK opsional karena bisa sudah ada
                // $t->foreign('sector_id')->references('id')->on('sectors')->cascadeOnUpdate()->restrictOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::table('sectors', function (Blueprint $t) {
            foreach (['slug','icon','summary','display_order','is_active'] as $col) {
                if (Schema::hasColumn('sectors', $col)) $t->dropColumn($col);
            }
        });
    }
};
