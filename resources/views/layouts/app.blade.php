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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    @include('partials.navbar')
    @yield('content') <!-- Render content -->

    @include('partials.modal')

    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Import Bootstrap JS Online -->
    <!-- Mengimpor file JavaScript lokal (public/js/script.js) dengan fungsi asset() agar Laravel menghasilkan URL yang benar. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Mengimpor Bootstrap JS (bundle) agar fitur seperti dropdown, modal, dan tooltip dapat berfungsi. -->
</body>

</html>