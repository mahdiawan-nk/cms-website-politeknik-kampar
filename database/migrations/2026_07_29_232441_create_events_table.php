<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // Kolom Multi-Bahasa (JSON)
            $table->jsonb('title');                  // Judul Agenda/Event
            $table->jsonb('location');               // Lokasi Acara
            $table->jsonb('content')->nullable();    // Deskripsi detail acara (opsional)

            // Kolom Waktu & Tanggal
            $table->date('event_date');             // Tanggal Pelaksanaan (misal: 2026-07-25)
            $table->time('start_time')->nullable(); // Waktu Mulai (misal: 08:30:00)
            $table->time('end_time')->nullable();   // Waktu Selesai (misal: 16:00:00)
            $table->string('time_zone')->default('WIB');

            // Atribut Tambahan
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');

            $table->timestamps();

            // Indexing untuk query pencarian agenda berdasarkan tanggal
            $table->index(['status', 'event_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
