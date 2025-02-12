<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
// namespace App\Http\Controllers: Menempatkan controller di namespace yang sesuai dengan konvensi Laravel.
// use App\Models\Task: Mengimpor model Task untuk mengakses data task dari database.
// use App\Models\TaskList: Mengimpor model TaskList untuk mengakses data list task.
// use Illuminate\Http\Request: Mengimpor kelas Request untuk menangani input dari form atau URL.


class TaskController extends Controller
{
    // Menampilkan halaman utama dengan daftar task dan task list
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian
        
        // Filter list dan task berdasarkan input pencarian
        $lists = TaskList::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        $tasks = Task::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Home',
            'lists' => $lists,
            'tasks' => $tasks,
            'priorities' => Task::PRIORITIES
        ];

        return view('pages.home', $data);
    }
//     Mengambil input pencarian dari URL (?search=value).
// Menggunakan query builder when() untuk memfilter daftar list (TaskList) dan task (Task) berdasarkan nama atau deskripsi.
// Mengurutkan task berdasarkan waktu pembuatan (created_at) dalam urutan menurun (desc).
// Mengirim data ke view pages.home:
// title: Judul halaman.
// lists: Data list yang difilter.
// tasks: Data task yang difilter.
// priorities: Prioritas task (diambil dari konstanta model Task::PRIORITIES).


    // Menambahkan task baru dengan validasi nama dan list_id
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'deskripsi' => 'max:255',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required|exists:task_lists,id' // Pastikan list_id sesuai dengan ID yang ada
        ]);

        Task::create([
            'name' => $request->name,
            'deskripsi' =>$request->deskripsi,
            'priority' =>$request->priority,
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'Task successfully added!');
    }
//     Memvalidasi data yang diterima:
// name wajib dan maksimal 100 karakter.
// deskripsi opsional, maksimal 255 karakter.
// priority wajib, harus salah satu dari low, medium, atau high.
// list_id wajib, harus sesuai dengan ID yang ada di tabel task_lists.
// Jika validasi berhasil, data task baru dibuat dengan metode Task::create().
// Redirect ke halaman sebelumnya dengan pesan sukses (Task successfully added!).


    // Menandai task sebagai selesai
    public function complete($id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'is_completed' => true
        ]);

        return redirect()->back()->with('success', 'Task marked as completed.');
    }
//     Mengambil task berdasarkan id menggunakan findOrFail(), yang akan menghasilkan 404 jika tidak ditemukan.
// Mengupdate field is_completed menjadi true untuk menandai task selesai.
// Redirect ke halaman sebelumnya dengan pesan sukses (Task marked as completed.).

    // Menghapus task berdasarkan ID
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task successfully deleted.');
    }
//     Mengambil task berdasarkan ID.
// Menghapus task menggunakan metode delete().
// Redirect ke halaman sebelumnya dengan pesan sukses (Task successfully deleted.).
// Menampilkan formulir edit untuk tugas tertentu
public function show($id)
 {
    $task = Task:: findOrFail($id);

    $data = [
        'title' => 'Details',
        'task' => $task,
    ];

    return view('pages.details',$data);
 }
}
// Mengambil task berdasarkan id, atau menampilkan error 404 jika tidak ditemukan.
// Mengirimkan data task ke view pages.details dengan judul halaman Details.


