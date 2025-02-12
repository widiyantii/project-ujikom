@extends('layouts.app')
<!-- Menggunakan template utama (layouts.app) sebagai kerangka dasar halaman ini. Semua elemen yang ada dalam layouts.app akan diwarisi oleh halaman ini, termasuk header, navbar, dan footer (jika ada). -->
@section('content')
<!-- Menandai awal dari bagian konten utama halaman. Bagian ini akan dimasukkan ke dalam @yield('content') yang ada di layouts.app.
blade
Copy
Edit -->
<h1>Halaman Category</h1>
<!-- Menampilkan judul halaman dengan elemen <h1>, yang berarti ini adalah heading utama halaman. Saat ini, hanya menampilkan teks statis "Halaman Category".
❗ Saran perbaikan:
Tambahkan lebih banyak konten – Misalnya, daftar kategori jika ini adalah halaman kategori.
Gunakan Bootstrap atau Tailwind – Agar tampilan lebih menarik, bisa ditambahkan kelas styling seperti text-center atau fw-bold.
Pastikan dynamic content – Jika kategori berasal dari database, gunakan @foreach untuk menampilkannya. -->
@endsection
<!-- Menandai akhir dari bagian @section('content'). Ini menutup bagian konten agar Blade Laravel memahami batas dari bagian ini. -->