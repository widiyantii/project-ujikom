<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor class untuk migrasi database
use Illuminate\Database\Schema\Blueprint; // Mengimpor class untuk mendefinisikan struktur tabel
use Illuminate\Support\Facades\Schema; // Mengimpor class Schema untuk operasi tabel

// Mengembalikan instance class anonim yang diperluas dari Migration
return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel task_lists.
     */
    public function up(): void
    {
        // Membuat tabel task_lists
        Schema::create('task_lists', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key dengan auto-increment
            $table->string('name')->unique(); // Membuat kolom name bertipe string dengan nilai unik
            $table->timestamps(); // Membuat kolom created_at dan updated_at secara otomatis
        });
    }

    /**
     * Membalik migrasi dengan menghapus tabel task_lists.
     */
    public function down(): void
    {
        // Menghapus tabel task_lists jika ada
        Schema::dropIfExists('task_lists');
    }
};