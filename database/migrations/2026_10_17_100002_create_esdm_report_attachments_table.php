<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('esdm_report_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('esdm_report_id')->constrained('esdm_reports')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_type')->default('image');
            $table->string('original_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esdm_report_attachments');
    }
};
