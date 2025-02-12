<nav class="navbar navbar-expand-lg bg-danger-subtle navbar-dark fixed-top">
    <!-- Membuat elemen navigasi (<nav>) dengan kelas Bootstrap:
navbar → Menandakan ini adalah navbar.
navbar-expand-lg → Navbar akan diperluas pada layar besar (ukuran lg ke atas).
bg-danger-subtle → Memberikan latar belakang berwarna merah muda (varian dari danger).
navbar-dark → Menggunakan teks warna terang agar kontras dengan latar belakang.
fixed-top → Navbar tetap di bagian atas saat halaman di-scroll (posisi tetap). -->
    <div class="container d-flex justify-content-between">
        <!-- Membungkus konten navbar dalam container untuk memastikan tata letak yang responsif, serta menggunakan d-flex justify-content-between untuk menyusun elemen di dalamnya agar tersebar ke ujung kiri dan kanan. -->
        <!-- Nama Aplikasi -->
        <a class="navbar-brand fw-bolder text-dark" href="#">{{ config('app.name') }}</a>
    </div>
</nav>
<!-- Membuat tautan (<a>) dengan kelas:
navbar-brand → Menandakan ini adalah merek atau nama aplikasi dalam navbar.
fw-bolder → Membuat teks lebih tebal.
text-dark → Mengubah warna teks menjadi hitam agar kontras dengan latar belakang.
href="#" → Saat ini tidak mengarah ke halaman tertentu (bisa diubah menjadi route('home') jika ada halaman utama).
{{ config('app.name') }} → Mengambil nama aplikasi dari konfigurasi Laravel (.env atau config/app.php). -->