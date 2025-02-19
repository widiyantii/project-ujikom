@extends('layouts.app')
<!-- ✔ Menggunakan layout utama app.blade.php, sehingga halaman ini akan mewarisi struktur dari layout tersebut. -->
<!-- ✔ Bagian @section('content') akan dimasukkan ke dalam @yield('content') yang ada di layout. -->
@section('content')
<div id="content" class="container">
    <div class="d-flex align-items-center">
        <a href="{{ route('home') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-left-short fs-4"></i>
            <span class="fw-bold fs-5">Kembali</span>
        </a>
    </div>
    <!-- ✔ Menampilkan tombol untuk kembali ke halaman utama (route('home')). -->
    <!-- ✔ Menggunakan Bootstrap icon (bi bi-arrow-left-short) untuk ikon panah kembali. -->
    <!-- ✔ Menerapkan class Bootstrap d-flex align-items-center untuk tata letak yang lebih rapi. -->

    @session('success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endsession
    <!-- ✔ Menampilkan pesan notifikasi sukses jika ada session success. -->
    <!-- ✔ Menggunakan Bootstrap alert alert-success dengan tombol close (btn-close). -->
    <!-- ✔ Alert dapat ditutup dengan data-bs-dismiss="alert". -->
    <div class="row my-3">
        <div class="col-8">
            <!-- ✔ Membagi halaman menjadi 2 bagian dengan Bootstrap Grid (col-8 untuk konten utama dan col-4 untuk detail task). -->
            <div class="card" style="height: 80vh;">
                <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                    <h3 class="fw-bold fs-4 text-truncate mb-0" style="width: 80%">
                        {{ $task->name }}
                        <span class="fs-6 fw-medium">di {{ $task->list->name }}</span>
                    </h3>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#editTaskModal">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </div>
                <!-- ✔ Menampilkan nama tugas ($task->name) dan daftar tempat tugas berada ($task->list->name). -->
                <!-- ✔ Menggunakan text-truncate untuk menghindari teks yang terlalu panjang. -->
                <!-- ✔ Menampilkan tombol edit (bi bi-pencil-square), yang membuka modal edit (#editTaskModal). -->


                <div class="card-body">
                    <p>
                        {{ $task->description }}
                    </p>
                </div>
                <!-- ✔ Menampilkan deskripsi tugas ($task->description). -->
                <div class="card-footer">
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" type="button" class="btn btn-sm btn-outline-danger w-100">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ✔ Formulir untuk menghapus tugas (tasks.destroy). -->
        <!-- ✔ Menggunakan metode DELETE untuk memastikan tindakan ini adalah penghapusan. -->
        <!-- ✔ Menampilkan tombol hapus berwarna merah (btn-outline-danger). -->
        <div class="col-4">
            <div class="card" style="height: 80vh;">
                <div class="card-header d-flex align-items-center justify-content-between overflow-hidden ">
                    <h3 class="fw-bold fs-4 text-truncate mb-0" style="width: 80%">Details</h3>
                </div>
                <!-- ✔ Menampilkan detail tambahan terkait tugas. -->
                <!-- ✔ Dibuat dalam kartu (card) dengan tinggi yang sama (80vh). -->
                <div class="card-body d-flex flex-column gap-2">
                    <form action="{{ route('tasks.changeList', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select class="form-select" name="list_id" onchange="this.form.submit()">
                            @foreach ($lists as $list)
                            <option value="{{ $list->id }}" {{ $list->id == $task->list_id ? 'selected' : '' }}>
                                {{ $list->name }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                    <!-- ✔ Form untuk memindahkan tugas ke daftar lain (tasks.changeList). -->
                    <!-- ✔ Otomatis mengirimkan form ketika pengguna memilih daftar baru (onchange="this.form.submit()"). -->
                    <h6 class="fs-6">
                        Priotitas:
                        <span class="badge text-bg-{{ $task->priorityClass }} badge-pill" style="width: fit-content">
                            {{ $task->priority }}
                        </span>
                    </h6>
                </div>
                <!-- ✔ Menampilkan prioritas tugas ($task->priority). -->
                <!-- ✔ Menggunakan warna latar belakang yang sesuai dengan kelas Bootstrap ($task->priorityClass). -->
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="modal-content">
            @method('PUT')
            @csrf
            <div class="modal-header ">
                <h1 class="modal-title fs-5" id="editTaskModalLabel">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- ✔ Modal Bootstrap untuk mengedit tugas (tasks.update). -->
            <!-- ✔ Menggunakan metode PUT untuk memperbarui data.✔ Modal Bootstrap untuk mengedit tugas (tasks.update). -->
            <!-- ✔ Menggunakan metode PUT untuk memperbarui data. -->
            <div class="modal-body">
                <input type="text" value="{{ $task->list_id }}" name="list_id" hidden>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $task->name }}" placeholder="Masukkan nama list">
                </div>
                <!-- ✔ Mengedit nama dan deskripsi tugas (name dan description). -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Masukkan deskripsi">{{ $task->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select class="form-control" name="priority" id="priority">
                        <option value="low" @selected($task->priority == 'low')>Low</option>
                        <option value="medium" @selected($task->priority == 'medium')>Medium</option>
                        <option value="high" @selected($task->priority == 'high')>High</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</div>
<!-- ✔ Tombol "Batal" untuk menutup modal tanpa menyimpan perubahan. -->
<!-- ✔ Tombol "Edit" untuk menyimpan perubahan ke database. -->
@endsection
<!-- Menampilkan detail tugas dengan deskripsi dan prioritas.
Memungkinkan pengeditan tugas langsung melalui modal.
Menggunakan AJAX-like submission untuk perpindahan daftar tugas. -->