<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor class Migration untuk migrasi database
use Illuminate\Database\Schema\Blueprint; // Mengimpor class Blueprint untuk mendefinisikan struktur tabel
use Illuminate\Support\Facades\Schema; // Mengimpor class Schema untuk operasi pada tabel

// Mengembalikan instance class anonim yang diperluas dari Migration
// instance class anonim adalah konsep di mana sebuah objek dibuat dari sebuah kelas yang tidak memiliki nama. Kelas anonim sendiri merupakan kelas yang didefinisikan secara langsung di tempat tertentu dalam kode, tanpa mendeklarasikan kelas tersebut dengan nama yang jelas.
return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel tasks.
     */
    public function up(): void
    {
        // Membuat tabel tasks
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key dengan auto-increment
            $table->string('name'); // Membuat kolom name bertipe string
            $table->string('description')->nullable(); // Kolom description bertipe string yang bisa bernilai null
            $table->boolean('is_completed')->default(false); // Kolom is_completed bertipe boolean dengan default false
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            // Kolom priority bertipe enum dengan nilai low, medium, dan high, default medium
            $table->timestamps(); // Membuat kolom created_at dan updated_at

            // Kolom foreign key list_id yang merujuk ke tabel task_lists pada kolom id
            // Jika task_list dihapus, maka data terkait pada tasks ikut dihapus (cascade)
            $table->foreignId('list_id')->constrained('task_lists', 'id')->onDelete('cascade');
        });
    }

    /**
     * Membalik migrasi dengan menghapus tabel tasks.
     */
    public function down(): void
    {
        // Menghapus tabel tasks jika ada
        Schema::dropIfExists('tasks');
    }
};
