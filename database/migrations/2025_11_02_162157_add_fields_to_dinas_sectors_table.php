<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dinas_sectors', function (Blueprint $table) {
            // letakkan kolom-kolom baru setelah id bila perlu
            $table->string('nama', 120)->after('id');
            $table->string('slug', 140)->unique()->after('nama');
            $table->string('icon', 120)->nullable()->after('slug');
            $table->text('summary')->nullable()->after('icon');
            $table->unsignedSmallInteger('display_order')->default(0)->after('summary');
            $table->boolean('is_active')->default(true)->after('display_order');
        });
    }

    public function down(): void
    {
        Schema::table('dinas_sectors', function (Blueprint $table) {
            $table->dropColumn(['nama', 'slug', 'icon', 'summary', 'display_order', 'is_active']);
        });
    }
};
