<?php

namespace Database\Seeders;
// Mendefinisikan namespace agar file ini berada dalam folder Database\Seeders, yang sesuai dengan struktur Laravel untuk seeder.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskList;
// WithoutModelEvents → Digunakan untuk menonaktifkan event model saat seeder dijalankan (tidak digunakan di kode ini, bisa dihapus).
// Seeder → Kelas bawaan Laravel untuk membuat seeder.
// TaskList → Mengimpor model TaskList agar bisa digunakan untuk menyimpan data ke database.
// ❗ Saran perbaikan:
// Bisa hapus WithoutModelEvents karena tidak digunakan.

class TaskListSeeder extends Seeder
// Mendefinisikan seeder bernama TaskListSeeder, yang digunakan untuk mengisi tabel task_lists dengan data awal.
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    // Metode run() dipanggil saat seeder dieksekusi. Method ini harus diisi dengan perintah untuk menambahkan data ke database.
    {
        $lists = [
            [
                'name' => 'Liburan',
            ],
            [
                'name' => 'Belajar',
            ],
            [
                'name' => 'Tugas',
            ],
            [
                'name' => 'pjok',
            ],
        ];
        // Mendeklarasikan array berisi daftar tugas (task_lists) yang akan dimasukkan ke dalam database.

        // Setiap elemen array adalah array asosiatif dengan kunci 'name'.
        // ❗ Saran perbaikan:

        // 'pjok' (nama kategori) lebih baik ditulis dengan huruf kapital untuk konsistensi, misalnya 'PJOK'.
        TaskList::insert($lists);
        //         insert($lists) → Menggunakan metode insert() untuk memasukkan semua data ke tabel task_lists dalam satu query.
        // Ini lebih efisien dibandingkan dengan create() karena tidak memicu event model secara individual.
        // ❗ Saran perbaikan:
        // Jika ingin event model tetap berjalan (misalnya untuk created event), gunakan TaskList::create($list) dalam loop foreach.
    }
}
