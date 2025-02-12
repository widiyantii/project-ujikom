<?php

namespace Database\Seeders;  
// Namespace untuk Seeder, sesuai struktur proyek Laravel.

use App\Models\Task;  
// Mengimpor model Task untuk manipulasi tabel tasks.

use App\Models\TaskList;  
// Mengimpor model TaskList untuk mengambil data list terkait.

use Illuminate\Database\Console\Seeds\WithoutModelEvents;  
// Menghindari pemicu event otomatis pada model saat seeding.

use Illuminate\Database\Seeder;  
// Kelas dasar untuk membuat seeder di Laravel.

class TaskSeeder extends Seeder  
{
    /**
     * Menjalankan proses seeding untuk tabel tasks.
     */
    public function run(): void
    {
        // Data yang akan dimasukkan ke tabel tasks.
        $tasks = [
            [
                'name' => 'Belajar Laravel', // Nama tugas
                'description' => 'Belajar Laravel di santri koding', // Deskripsi tugas
                'is_completed' => false, // Status apakah tugas selesai atau belum
                'priority' => 'medium', // Prioritas tugas
                'list_id' => TaskList::where('name', 'Belajar')->first()->id, 
                // Mengambil ID dari TaskList dengan nama 'Belajar'
            ],
            [
                // Tugas untuk belajar React
                'name' => 'Belajar React', // Nama tugas
                'description' => 'Belajar React di WPU', // Penjelasan atau deskripsi tugas
                'is_completed' => true, // Status tugas: true (sudah selesai)
                'priority' => 'high', // Prioritas tugas: high (tinggi)
                'list_id' => TaskList::where('name', 'Belajar')->first()->id, 
                // Mengambil ID dari TaskList dengan nama "Belajar"
            ],
            [
                // Tugas liburan ke Pantai
                'name' => 'Pantai', 
                'description' => 'Liburan ke Pantai bersama keluarga', 
                'is_completed' => false, // Status tugas: false (belum selesai)
                'priority' => 'low', // Prioritas tugas: low (rendah)
                'list_id' => TaskList::where('name', 'Liburan')->first()->id, 
                // Mengambil ID dari TaskList dengan nama "Liburan"
            ],
            [
                // Tugas liburan ke Villa
                'name' => 'Villa',
                'description' => 'Liburan ke Villa bersama teman sekolah',
                'is_completed' => true, // Status tugas: true (sudah selesai)
                'priority' => 'medium', // Prioritas tugas: medium (sedang)
                'list_id' => TaskList::where('name', 'Liburan')->first()->id, 
            ],
            [
                // Tugas Matematika dari Bu Nina
                'name' => 'Matematika',
                'description' => 'Tugas Matematika bu Nina',
                'is_completed' => true, // Status tugas: true (sudah selesai)
                'priority' => 'medium', 
                'list_id' => TaskList::where('name', 'Tugas')->first()->id,
            ],
            [
                // Tugas presentasi PAIBP
                'name' => 'PAIBP',
                'description' => 'Tugas presentasi pa Budi',
                'is_completed' => false, // Status tugas: false (belum selesai)
                'priority' => 'high', 
                'list_id' => TaskList::where('name', 'Tugas')->first()->id,
            ],
            [
                // Project besar Todo App untuk ujikom
                'name' => 'Project Ujikom',
                'description' => 'Membuat project Todo App untuk ujikom',
                'is_completed' => false, 
                'priority' => 'high', 
                'list_id' => TaskList::where('name', 'Tugas')->first()->id,
            ],
            [
                // project besar Todo app untuk ujikom
                'name' => 'pjok',
                'description' => 'olah raga setiap pagi',
                'is_completed' => true, 
                'priority' => 'medium', 
                'list_id' => TaskList::where('name', 'pjok')->first()->id,
            ]
        ];

        // Memasukkan semua data di array $tasks ke dalam tabel tasks.
        Task::insert($tasks);
    }
}