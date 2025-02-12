<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    // Menyimpan task list baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input: 'name' wajib diisi dengan maksimal 100 karakter
        $request->validate([
            'name' => 'required|max:100'
        ]);

        // Membuat task list baru menggunakan data dari request
        TaskList::create([
            'name' => $request->name
        ]);

        // Redirect kembali ke halaman sebelumnya setelah berhasil menyimpan
        return redirect()->back()->with('success', 'Task list successfully created!');
    }

    // Menghapus task list berdasarkan ID
    public function destroy($id)
    {
        // Mencari task list berdasarkan ID, jika tidak ditemukan akan menampilkan error 404
        $taskList = TaskList::findOrFail($id);

        // Menghapus task list yang ditemukan
        $taskList->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Task list successfully deleted!');
    }
}
