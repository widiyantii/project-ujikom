<?php

namespace App\Http\Controllers;
// Menandakan bahwa file ini adalah bagian dari controller dalam Laravel.

use App\Models\Task;
// Menggunakan model Task, yang biasanya terhubung dengan tabel 'tasks' di database.

use App\Models\TaskList;
// Menggunakan model TaskList, yang mungkin merupakan daftar tugas.

use Illuminate\Http\Request;
// Memungkinkan pengambilan data dari permintaan HTTP (misalnya, dari formulir atau API).

class TaskController extends Controller
{
    // Fungsi untuk menampilkan daftar tugas dan daftar tugas yang tersedia
    public function index(Request $request)
    {
        $query = $request->input('query'); // Mengambil input pencarian dari request

        if ($query) {
            // Mencari tugas berdasarkan nama atau deskripsi yang cocok dengan query
            $tasks = Task::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->latest() // Mengurutkan dari yang terbaru
                ->get();

            // Mencari daftar tugas berdasarkan nama atau tugas di dalamnya yang cocok dengan query
            $lists = TaskList::where('name', 'like', "%{$query}%")
                ->orWhereHas('tasks', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                //     TaskList::where(...) → Mengambil data dari model TaskList, yang biasanya merepresentasikan tabel task_lists di database.
                // 'name' → Menunjukkan kolom yang ingin dicari, yaitu kolom name dalam tabel task_lists.
                // 'like' → Operator pencarian yang digunakan dalam SQL untuk mencari pola tertentu dalam teks.
                // "%{$query}%" → Menggunakan wildcard % untuk mencari nama yang mengandung nilai dalam $query:
                // % di awal berarti nama boleh diawali dengan teks lain sebelum $query.
                // % di akhir berarti nama boleh memiliki teks lain setelah $query.
                // Misalnya, jika $query = "task", maka query ini akan cocok dengan "Daily Task", "task list", "my tasks", dll.
                ->with('tasks') // Memuat tugas-tugas yang ada dalam daftar tugas yang ditemukan
                ->get();

            // Jika tidak ada tugas yang ditemukan, pastikan semua daftar tugas tetap dimuat
            if ($tasks->isEmpty()) {
                $lists->load('tasks');
            } else {
                // Jika ada tugas yang ditemukan, hanya memuat tugas-tugas yang cocok dengan query
                $lists->load(['tasks' => function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                }]);
            }
        } else {
            // Jika tidak ada query pencarian, ambil semua tugas dan daftar tugas
            $tasks = Task::latest()->get();
            $lists = TaskList::with('tasks')->get();
        }

        // Menyiapkan data yang akan dikirim ke tampilan (view)
        $data = [
            'title' => 'Home',
            'lists' => $lists,
            'tasks' => $tasks,
            'priorities' => Task::PRIORITIES // Prioritas tugas yang didefinisikan di model Task
        ];

        return view('pages.home', $data); // Menampilkan halaman utama dengan data tugas dan daftar tugas
    }

    // Fungsi untuk menyimpan tugas baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'name' => 'required|max:100', // Nama tugas wajib diisi, maksimal 100 karakter
            'description' => 'max:255', // Deskripsi maksimal 255 karakter
            'list_id' => 'required' // list_id wajib diisi
        ]);

        // Menyimpan data tugas ke dalam database
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'list_id' => $request->list_id
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya setelah tugas disimpan
    }

    // Fungsi untuk menandai tugas sebagai selesai
    public function complete($id)
    {
        Task::findOrFail($id)->update([
            'is_completed' => true // Mengubah status tugas menjadi selesai (true)
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya setelah update
    }

    // Fungsi untuk menghapus tugas berdasarkan ID
    public function destroy($id)
    {
        Task::findOrFail($id)->delete(); // Mencari tugas dan menghapusnya dari database

        return redirect()->route('home'); // Redirect ke halaman utama setelah tugas dihapus
    }

    // Fungsi untuk menampilkan detail dari suatu tugas
    public function show($id)
    {
        $data = [
            'title' => 'Task', // Judul halaman
            'lists' => TaskList::all(), // Mengambil semua daftar tugas
            'task' => Task::findOrFail($id), // Mengambil tugas berdasarkan ID
        ];

        return view('pages.details', $data); // Menampilkan halaman detail tugas
    }

    // Fungsi untuk mengubah daftar tugas dari suatu tugas
    public function changeList(Request $request, Task $task)
    {
        // Validasi input list_id yang harus ada dalam tabel task_lists
        $request->validate([
            'list_id' => 'required|exists:task_lists,id',
        ]);

        // Mengupdate tugas dengan list_id yang baru
        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'List berhasil diperbarui!');
        // Kembali ke halaman sebelumnya dengan pesan sukses
    }

    // Fungsi untuk mengupdate data tugas yang sudah ada
    public function update(Request $request, Task $task)
    {
        // Validasi input dari request
        $request->validate([
            'list_id' => 'required', // list_id wajib diisi
            'name' => 'required|max:100', // Nama tugas wajib diisi, maksimal 100 karakter
            'description' => 'max:255', // Deskripsi maksimal 255 karakter
            'priority' => 'required|in:low,medium,high' // Prioritas harus berisi salah satu dari nilai ini
        ]);

        // Mengupdate data tugas berdasarkan ID
        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority
        ]);

        return redirect()->back()->with('success', 'Task berhasil diperbarui!');
        // Kembali ke halaman sebelumnya dengan pesan sukses
    }
}
// ✅ Controller ini bertanggung jawab atas CRUD (Create, Read, Update, Delete) untuk tugas (Task).
// ✅ Menggunakan Eloquent untuk berinteraksi dengan database.
// ✅ Memastikan validasi input sebelum menyimpan atau memperbarui data.
// ✅ Menggunakan redirect dan flash messages agar lebih interaktif.