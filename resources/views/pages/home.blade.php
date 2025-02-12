@extends('layouts.app')
<!-- Menggunakan template layouts.app sebagai layout utama untuk halaman ini. -->

@section('content')
<!-- Menandai awal dari bagian konten halaman yang akan dimasukkan ke dalam template layouts.app.
blade
Copy
Edit -->

<div id="content" class="overflow-y-hidden overflow-x-hidden">
    <!-- Membungkus seluruh konten dalam div dengan ID "content" dan menyembunyikan overflow pada sumbu X dan Y. -->
    <div class="row mb-3">
        <div class="col-6 mx-auto">
            <form action="{{ route('tasks.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari tugas atau list...">
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </form>
        </div>
    </div>
    <!-- Membuat form pencarian dengan input teks dan tombol submit untuk mencari tugas atau daftar (list). Formulir ini mengirimkan data ke tasks.index menggunakan metode GET. -->
    @if ($lists->count() == 0)
    <!-- Mengecek apakah tidak ada list yang tersedia. Jika jumlahnya nol, maka menampilkan pesan dan tombol untuk menambah list baru. -->
    <div class="d-flex flex-column align-items-center">
        <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
        <button type="button" class="btn btn-sm d-flex align-items-center gap-2 btn-outline-primary"
            style="width: fit-content;">
            <i class="bi bi-plus-square fs-3"></i> Tambah
        </button>
    </div>
    <!-- Menampilkan pesan bahwa tidak ada tugas dan menyediakan tombol untuk menambahkan tugas. -->
    @endif
    <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
        <!-- Membungkus daftar list dalam container yang dapat di-scroll secara horizontal (overflow-x-scroll) dengan tinggi 100vh. -->
        @foreach ($lists as $list)
        <!-- Melakukan iterasi pada setiap list yang ada dalam database. -->
        <div class="card flex-shrink-0 bg-danger-subtle" style="width: 18rem; max-height: 80vh;">
            <!-- Membuat kartu untuk setiap list dengan lebar 18rem dan tinggi maksimal 80vh. -->
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">{{ $list->name }}</h4>
                <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm p-0">
                        <i class="bi bi-trash fs-5 text-danger"></i>
                    </button>
                </form>
            </div>
            <!-- Membuat bagian header kartu yang menampilkan nama list dan tombol hapus (trash). Saat tombol hapus ditekan, akan mengirimkan permintaan DELETE ke lists.destroy. -->
            <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                <!-- Membungkus isi kartu dengan gaya kolom yang berjarak (gap-2) dan menghindari overflow pada sumbu X. -->
                @foreach ($tasks as $task)
                @if ($task->list_id == $list->id)
                <!-- Mengecek setiap task yang ada dan menampilkannya hanya jika list_id cocok dengan ID list saat ini. -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <a href="{{ route ('tasks.show', $task->id) }}"
                                    class="fw-bold lh-1 m-0 {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                    {{ $task->name }}
                                </a>
                                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill"
                                    style="width: fit-content">
                                    {{ $task->priority }}
                                </span>
                            </div>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm p-0">
                                    <i class="bi bi-x-circle text-danger fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Membuat kartu untuk setiap task, menampilkan nama tugas, prioritas (dengan warna dinamis berdasarkan priorityClass), serta tombol hapus tugas. -->
                    <div class="card-body">
                        <p class="card-text text-truncate">
                            {{ $task->description }}
                        </p>
                    </div>
                    <!-- Menampilkan deskripsi tugas dengan pemotongan teks (text-truncate) jika terlalu panjang. -->
                    @if (!$task->is_completed)
                    <div class="card-footer">
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                <span class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-check fs-5"></i>
                                    Selesai
                                </span>
                            </button>
                        </form>

                    </div>
                    @endif
                </div>
                <!-- Jika tugas belum selesai, maka tombol "Selesai" akan muncul untuk menyelesaikan tugas dengan mengirimkan permintaan PATCH ke tasks.complete. -->
                @endif
                @endforeach
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                    <span class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus fs-5"></i>
                        Tambah
                    </span>
                </button>
            </div>
            <!-- Tombol untuk menambah tugas baru ke dalam list. Saat ditekan, akan membuka modal #addTaskModal dengan list_id sebagai data tambahan. -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
            </div>
        </div>
        <!-- Menampilkan jumlah tugas dalam list. -->
        @endforeach
        <button type="button" class="btn btn-danger flex-shrink-0" style="width: 18rem; height: fit-content;"
            data-bs-toggle="modal" data-bs-target="#addListModal">
            <span class="d-flex align-items-center justify-content-center">
                <i class="bi bi-plus fs-5"></i>
                Tambah
            </span>
        </button>
        <!-- Tombol untuk menambah list baru dengan membuka modal #addListModal. -->
    </div>
</div>
@endsection
<!-- Menutup bagian konten dari @section('content'). -->