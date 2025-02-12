<!DOCTYPE html>
<html lang="en">
<!-- Mendefinisikan dokumen sebagai HTML5 dan menetapkan bahasa utama sebagai bahasa Inggris (lang="en"). -->

<head>
    <meta charset="UTF-8">
    <!-- Menyetel karakter encoding ke UTF-8 agar mendukung berbagai karakter, termasuk simbol dan bahasa non-Inggris. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mengatur tampilan responsif pada perangkat mobile agar skala awalnya sesuai dengan lebar layar (width=device-width) dan tidak diperbesar secara otomatis (initial-scale=1.0).
html
Copy
Edit -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Memastikan kompatibilitas dengan versi terbaru dari Internet Explorer. -->
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <!-- Mengatur judul halaman dengan format: Judul Halaman - Nama Aplikasi.
{{ $title }} → Variabel judul yang kemungkinan diisi dari controller.
{{ config('app.name') }} → Mengambil nama aplikasi dari konfigurasi Laravel (config/app.php).
❗ Saran perbaikan:
Tambahkan @isset($title) untuk menghindari error jika variabel $title tidak didefinisikan. -->
    <!-- Import Bootstrap CSS Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Mengimpor Bootstrap 5.3.2 CSS dan Bootstrap Icons dari CDN untuk mempercepat akses dan mengurangi beban server. -->
</head>

<body>
    @include('partials.navbar') <!-- Mengambil component navbar -->
    <!-- Menggunakan @include('partials.navbar') untuk menyertakan file navbar.blade.php dari folder partials.
Ini membantu dalam modularisasi kode agar navbar tidak perlu ditulis ulang di setiap halaman. -->
    @yield('content') <!-- Render content -->
    <!-- Menentukan tempat di mana konten halaman spesifik akan dirender.
Setiap halaman yang menggunakan layout ini harus mendefinisikan @section('content'). -->
    @include('partials.modal')
    <!-- Menggunakan @include untuk menyertakan modal (kemungkinan untuk konfirmasi atau formulir modal).
Jika modal tidak selalu diperlukan, bisa gunakan @isset($modal) agar lebih fleksibel. -->
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Import Bootstrap JS Online -->
    <!-- Mengimpor file JavaScript lokal (public/js/script.js) dengan fungsi asset() agar Laravel menghasilkan URL yang benar. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Mengimpor Bootstrap JS (bundle) agar fitur seperti dropdown, modal, dan tooltip dapat berfungsi. -->
</body>

</html>