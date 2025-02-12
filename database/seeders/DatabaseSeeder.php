<?php

namespace Database\Seeders;  
// Namespace untuk seeder di Laravel sesuai struktur proyek.

use Illuminate\Database\Seeder;  
use Database\Seeders\TaskListSeeder;
// Kelas dasar untuk seeder yang perlu diwarisi.

class DatabaseSeeder extends Seeder  
{
    /**
     * Seed the application's database. ("Seed the application's database" dalam konteks Laravel berarti mengisi database aplikasi dengan data awal (dummy data) yang digunakan untuk kebutuhan pengembangan atau pengujian.)
     */
    public function run(): void
    {
        // Memanggil seeder TaskListSeeder untuk mengisi tabel task_lists.
        $this->call(TaskListSeeder::class);

        // Memanggil seeder TaskSeeder untuk mengisi tabel tasks.
        $this->call(TaskSeeder::class);
    }
}