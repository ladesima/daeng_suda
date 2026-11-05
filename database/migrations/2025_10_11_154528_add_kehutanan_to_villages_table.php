<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('villages', function (Blueprint $t) {
            if (!Schema::hasColumn('villages','kehutanan')) {
                $t->json('kehutanan')->nullable()->after('energi');
            }
        });
    }
    public function down(): void {
        Schema::table('villages', function (Blueprint $t) {
            if (Schema::hasColumn('villages','kehutanan')) {
                $t->dropColumn('kehutanan');
            }
        });
    }
};
