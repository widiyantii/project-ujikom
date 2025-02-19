@extends('layouts.app')

@section('content')
<div id="content" class="overflow-y-hidden overflow-x-hidden">
    <!-- Jika tidak ada list tugas, tampilkan pesan dan tombol tambah -->
    @if ($lists->count() == 0)
    <div class="d-flex flex-column align-items-center">
        <p class="text-center fst-italic">Belum ada tugas yang ditambahkan</p>
        <button type="button" class="btn d-flex align-items-center gap-2" style="width: fit-content;"
            data-bs-toggle="modal" data-bs-target="#addListModal">
            <i class="bi bi-plus-square fs-1"></i>
        </button>
    </div>
    <!-- ode ini digunakan untuk: ✅ Menampilkan pesan ketika daftar tugas kosong.
✅ Menyediakan tombol untuk menambahkan daftar tugas baru melalui modal pop-up. -->
    @endif

    <!-- Form pencarian tugas atau list -->
    <div class="row my-3">
        <div class="col-6 mx-auto">
            <form action="{{ route('home') }}" method="GET" class="d-flex gap-2">
                <input type="text" class="form-control" name="query" placeholder="Cari tugas atau list..."
                    value="{{ request()->query('query') }}">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
            </form>
        </div>
    </div>


    <!-- Menampilkan daftar tugas dalam bentuk kartu -->
    <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
        @foreach ($lists as $list)
        <div class="card flex-shrink-0 bg-danger-subtle" style="width: 18rem; max-height: 80vh;">
            <!-- Header kartu dengan nama list dan tombol hapus -->
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
            <!-- Kode ini berfungsi untuk menampilkan daftar list tugas dalam bentuk kartu, dengan fitur: ✅ Scroll horizontal jika list banyak.
✅ Tombol hapus untuk menghapus list tertentu.
✅ Desain responsif menggunakan Bootstrap.  -->

            <!-- Daftar tugas dalam list -->
            <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                @foreach ($list->tasks as $task)
                <div class="card {{ $task->is_completed ? 'bg-success-subtle' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Indikator prioritas tugas -->
                                @if ($task->priority == 'high' && !$task->is_completed)
                                <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}"
                                    role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <!-- Kode ini berfungsi untuk: ✅ Menampilkan daftar tugas dalam bentuk kartu kecil.
✅ Menandai tugas yang selesai dengan warna hijau.
✅ Menampilkan indikator "loading" untuk tugas prioritas tinggi yang belum selesai -->

                                @endif
                                <!-- Nama tugas dengan status selesai atau belum -->
                                <a href="{{ route('tasks.show', $task->id) }}"
                                    class="fw-bold lh-1 m-0 text-decoration-none text-{{ $task->priorityClass }} {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                    {{ $task->name }}
                                </a>
                            </div>
                            <!-- ✅ Menampilkan nama tugas sebagai link ke halaman detail tugas.
✅ Mengatur warna teks berdasarkan prioritas tugas.
✅ Jika tugas selesai, teks akan dicoret untuk menunjukkan bahwa tugas sudah dikerjakan -->

                            <!-- Tombol hapus tugas -->
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
                    <!-- ✅ Kode ini memungkinkan pengguna menghapus tugas dengan satu klik.
✅ Menggunakan metode DELETE dengan spoofing method Laravel (@method('DELETE')).
✅ Tombol hapus ditampilkan dengan ikon X merah untuk kemudahan penggunaan.  -->

                    <div class="card-body">
                        <!-- Deskripsi tugas -->
                        <p
                            class="card-text text-truncate {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                            {{ $task->description }}
                        </p>
                    </div>
                    <!-- ✅ Kode ini menampilkan deskripsi tugas dengan tampilan responsif.
✅ Memberikan efek coret (text-decoration-line-through) jika tugas sudah selesai.
✅ Menggunakan text-truncate agar teks panjang tetap rapi di kartu tugas. -->

                    <!-- Tombol untuk menyelesaikan tugas -->
                    @if (!$task->is_completed)
                    <div class="card-footer">
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                <span class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-check fs-5"></i>
                                    Selesai
                                </span>
                            </button>
                        </form>
                    </div>
                    <!-- ✅ Kode ini menampilkan tombol untuk menyelesaikan tugas.
✅ Saat ditekan, tugas akan diperbarui menjadi selesai (completed).
✅ Menggunakan metode PATCH untuk memperbarui status di database.  -->

                    @endif
                </div>
                @endforeach
                <!-- Tombol tambah tugas dalam list -->
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                    <span class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus fs-5"></i>
                        Tambah
                    </span>
                </button>
            </div>

            <!-- Footer kartu, menampilkan jumlah tugas -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
            </div>
        </div>
        @endforeach

        <!-- Tombol tambah list baru jika list sudah ada -->
        @if ($lists->count() !== 0)
        <button type="button" class="btn btn-outline-danger flex-shrink-0"
            style="width: 18rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
            <span class="d-flex align-items-center justify-content-center">
                <i class="bi bi-plus fs-5"></i>
                Tambah
            </span>
        </button>
        @endif
    </div>
</div>
@endsection