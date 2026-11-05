<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('esdm_report_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('esdm_report_id')->constrained('esdm_reports')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('catatan')->nullable();
            $table->string('instansi_koordinasi')->nullable();
            $table->text('hasil_koordinasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esdm_report_histories');
    }
};
