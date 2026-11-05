<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            if (!Schema::hasColumn('announcements', 'title')) {
                $table->string('title')->after('id');
            }
            if (!Schema::hasColumn('announcements', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title');
            }
            if (!Schema::hasColumn('announcements', 'body')) {
                $table->text('body')->after('slug');
            }
            if (!Schema::hasColumn('announcements', 'is_active')) {
                $table->boolean('is_active')->default(true)->index()->after('body');
            }
            if (!Schema::hasColumn('announcements', 'published_at')) {
                $table->timestamp('published_at')->nullable()->index()->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            if (Schema::hasColumn('announcements', 'published_at')) $table->dropColumn('published_at');
            if (Schema::hasColumn('announcements', 'is_active'))    $table->dropColumn('is_active');
            if (Schema::hasColumn('announcements', 'body'))         $table->dropColumn('body');
            if (Schema::hasColumn('announcements', 'slug')) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('announcements', 'title'))        $table->dropColumn('title');
        });
    }
};
