<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;
// Mengimpor kelas yang dibutuhkan:
// TaskController: Controller untuk menangani task.
// TaskListController: Controller untuk menangani list dari task.
// Route: Kelas Laravel untuk membuat rute aplikasi.


// Membuat route untuk home
Route::get('/', [TaskController::class, 'index'])->name('home');
// Membuat rute GET ke URL / yang memanggil metode index dari TaskController.
// name('home'): Memberikan nama rute home, yang mempermudah pemanggilan rute ini di Blade atau controller.

Route::get('/tasks/{task}', function () {
    return redirect()->route('tasks.index');
});
// Rute untuk menangani permintaan dengan format /tasks/{task}.
// Fungsi anonim (Closure) digunakan untuk langsung me-redirect ke rute tasks.index, yang kemungkinan besar adalah halaman daftar task.


Route::resource('lists', TaskListController::class);
// Membuat rute CRUD otomatis untuk lists, yang terkait dengan TaskListController.
// Rute yang otomatis dihasilkan:
// GET /lists: Menampilkan semua list (index).
// GET /lists/create: Form untuk membuat list baru (create).
// POST /lists: Menyimpan list baru (store).
// GET /lists/{list}: Menampilkan detail list tertentu (show).
// GET /lists/{list}/edit: Form untuk edit list (edit).
// PUT/PATCH /lists/{list}: Memperbarui list (update).
// DELETE /lists/{list}: Menghapus list (destroy).

Route::resource('tasks', TaskController::class);
// Membuat rute CRUD otomatis untuk tasks, terkait dengan TaskController.
// Sama seperti resource route untuk lists, tetapi ditujukan untuk task.
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
// Membuat rute dengan metode HTTP PATCH untuk URL /tasks/{task}/complete.
// Memanggil metode complete dari TaskController.
// name('tasks.complete'): Menamakan rute ini sebagai tasks.complete.
// Kemungkinan digunakan untuk menandai bahwa suatu task telah selesai.

