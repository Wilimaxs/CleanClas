<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- passing title -->
  <title>CleanClass - @yield('title')</title>
  @vite(['resources/sass/app.sass', 'resources/js/app.js', 'resources/css/app.css'])
  <style>
    .content-wrapper {
      height: 100vh; /* Set tinggi maksimum agar dapat di-scroll */
      overflow-y: auto; /* Aktifkan overflow-y agar konten di-scroll saat melebihi tinggi maksimum */
    }
  </style>
</head>
<body>
  <!-- passing content -->
  <div class="content-wrapper">

    @yield('content')
  </div>
</body>
</html>