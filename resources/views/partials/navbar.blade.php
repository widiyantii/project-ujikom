<!-- Navbar dengan background warna biru dan mode gelap -->
<nav class="navbar navbar-expand-lg bg-danger-subtle navbar-dark fixed-top">
    <div class="container d-flex justify-content-center">
        <!-- Tautan untuk menuju halaman utama, menampilkan nama aplikasi -->
        <div>
            <a class="navbar-brand fw-bolder text-dark" href="#">
                {{ config('app.name') }} <!-- Mengambil nama aplikasi dari konfigurasi -->
            </a>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            profile
        </button>
    </div>
</nav>