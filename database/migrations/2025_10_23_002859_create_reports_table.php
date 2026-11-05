<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            // emergency | assistance
            $table->string('type', 20);
            // pelapor
            $table->string('reporter_name');
            $table->string('reporter_phone', 30);
            $table->string('reporter_email')->nullable();

            // lokasi (bebas, tanpa relasi supaya cepat dipakai publik)
            $table->string('village')->nullable();   // Desa/Kel
            $table->string('district')->nullable(); // Kecamatan
            $table->string('address')->nullable();
            $table->decimal('lat', 10, 6)->nullable();
            $table->decimal('lng', 10, 6)->nullable();

            // konten utama
            $table->string('category')->nullable();      // ex: kekeringan/hama/pencemaran/lain
            $table->string('assistance_type')->nullable(); // ex: pompa air, irigasi, dsb
            $table->text('description')->nullable();
            $table->string('severity', 20)->nullable();  // rendah/sedang/tinggi
            $table->string('urgency', 20)->nullable();   // rendah/sedang/tinggi
            $table->dateTime('occurred_at')->nullable();

            // lampiran
            $table->json('photos')->nullable();       // untuk emergency
            $table->json('attachments')->nullable();  // untuk assistance

            // tracking
            $table->string('tracking_code', 16)->index();
            $table->string('status', 20)->default('submitted'); // submitted|in_review|in_progress|done|rejected
            $table->text('follow_up_note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
