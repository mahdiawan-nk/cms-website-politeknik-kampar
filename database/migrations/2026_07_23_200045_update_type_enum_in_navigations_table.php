<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Hapus constraint bawaan Laravel yang lama
        DB::statement('ALTER TABLE navigations DROP CONSTRAINT IF EXISTS navigations_type_check');

        // 2. Buat constraint baru yang menyertakan 'nolink'
        DB::statement("ALTER TABLE navigations ADD CONSTRAINT navigations_type_check CHECK (\"type\"::text IN ('internal', 'external', 'nolink'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Hapus constraint yang baru
        DB::statement('ALTER TABLE navigations DROP CONSTRAINT IF EXISTS navigations_type_check');

        // 2. Kembalikan ke constraint lama (Pastikan tidak ada record bernilai 'nolink' saat down dijalankan)
        DB::statement("ALTER TABLE navigations ADD CONSTRAINT navigations_type_check CHECK (\"type\"::text IN ('internal', 'external'))");
    }
};
