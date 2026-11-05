<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('sectors', function (Blueprint $t) {
            if (!Schema::hasColumn('sectors','order')) {
                $t->unsignedSmallInteger('order')->default(0)->after('summary');
            }
        });
    }
    public function down(): void {
        Schema::table('sectors', function (Blueprint $t) {
            if (Schema::hasColumn('sectors','order')) {
                $t->dropColumn('order');
            }
        });
    }
};
