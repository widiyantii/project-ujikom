@extends('layouts.app')
<!-- Menandai awal dari bagian konten halaman yang akan dimasukkan ke dalam layouts.app. -->
@section('content')
<div id="content" class="container pb-3">
    <!-- Membungkus seluruh konten dalam div dengan ID content, menggunakan kelas Bootstrap container untuk tata letak responsif, serta pb-3 (padding-bottom) untuk memberi sedikit ruang di bawah. -->
    <div class="d-flex align-items-center justify-content center">
        <!-- Menggunakan Flexbox untuk menata elemen di dalamnya agar sejajar secara vertikal (align-items-center) dan berada di tengah horizontal (justify-content-center). -->
        <a href="{{ route('home') }}" class="btn btn-sm fw-bold fs-4">
            <i class="bi bi-arrow-left-short"></i>
            kembali
        </a>
    </div>
    <!-- Membuat tombol kembali dengan:
btn btn-sm → Tombol kecil.
fw-bold → Teks tebal.
fs-4 → Ukuran font besar.
<i class="bi bi-arrow-left-short"></i> → Ikon panah kiri dari Bootstrap Icons.
route('home') → Mengarahkan pengguna kembali ke halaman utama.*
❗ Saran perbaikan:
justify-content center memiliki typo, harusnya justify-content-center agar bekerja dengan benar. -->
    <div class="row">
        <div class="col-8">
            <!-- Membuat layout grid Bootstrap dengan row, dan membagi layar menjadi 8 kolom (col-8) untuk konten utama. -->
            <div class="card" style="height: 80vh; max-height: 80vh;">
                <!-- Membuat kartu (card) dengan tinggi tetap 80vh agar ukurannya seragam dan tidak terlalu panjang.
blade
Copy
Edit -->
                <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                    <!-- Membuat header kartu dengan Flexbox untuk menyusun elemen di dalamnya secara horizontal, serta overflow-hidden untuk mencegah teks atau elemen lain meluap keluar. -->
                    <h3 class="fw-bold fs-4 text-truncate" style="max-width: 100%;">{{ $task->name }}</h3>
                    <!-- Menampilkan nama tugas (task->name) dengan:
fw-bold → Teks tebal.
fs-4 → Ukuran font besar.
text-truncate → Memotong teks jika terlalu panjang agar tetap rapi.* -->
                    <i class="bi bi-pencil-square fs-4"></i>
                    <!-- Ikon pensil dari Bootstrap Icons untuk mengindikasikan fitur edit tugas (tapi belum ada fungsionalitasnya).
❗ Saran perbaikan:
Bisa bungkus ikon ini dengan <a href="#"> atau tombol button untuk memberikan aksi edit tugas nantinya.* -->
                </div>
                <div class="card-body">
                    <p>
                        {{ $task->description }}
                    </p>
                </div>
                <!-- Menampilkan deskripsi tugas di dalam body kartu.
blade
Copy
Edit -->
                <div class="card-footer">
                    <div class="btn btn-outline-danger w-100">Hapus</div>
                </div>
            </div>
        </div>
        <!-- Membuat tombol hapus dengan:
btn-outline-danger → Tombol berwarna merah dengan gaya outline.
w-100 → Memastikan tombol melebar ke seluruh lebar kartu.*
❗ Saran perbaikan:
Sebaiknya tombol ini dibuat dalam bentuk <form> dengan metode POST atau DELETE untuk benar-benar menghapus tugas dari database.* -->
        <div class="col-4">
            <div class="card" style="height: 80vh; max-height: 80vh;">

            </div>
        </div>
    </div>
</div>
<!-- Membuat kolom tambahan (col-4), mungkin untuk detail tambahan atau fitur lainnya, tetapi saat ini masih kosong. -->
@endsection
<!-- Menandai akhir dari bagian konten dalam @section('content'). -->