<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('esdm_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_id')->constrained('villages')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('type');
            $table->string('status')->default('baru');
            $table->text('lokasi')->nullable();
            $table->json('data')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tingkat_urgensi')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('village_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esdm_reports');
    }
};
