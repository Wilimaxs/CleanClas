<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    @vite(['resources/css/template-home.css', 'resources/js/animation.js', 'resources/css/example.css', 'resources/css/form.css'])
    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Righteous&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <title>CleanClass @yield('title')</title>
    <link rel="icon" href="assets/images/icon.ico">
    <style>
    .content-wrapper {
      height: 100vh; /* Set tinggi maksimum agar dapat di-scroll */
      overflow-y: auto; /* Aktifkan overflow-y agar konten di-scroll saat melebihi tinggi maksimum */
    }
  </style>
</head>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <img src="{{ asset('/uploads/image/profil_admin-modified.png') }}" alt="">
        <span class="text">CleanClass <br> <span style="font-family: 10px;">Admin</span></span>
    </a>
    <ul class="side-menu top">
        <li class="{{ Request::is('home-siswa') ? 'active' : '' }}">
            <a href="/posts/create" id="sidebar-home">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Data Guru</span>
            </a>
        </li>
        <li class="{{ Request::is('leaderboard') ? 'active' : '' }}">
            <a href="/Psiswa/create" id="sidebar-leaderboard">
                <i class='bx bx-trophy'></i>
                <span class="text">Data Siswa</span>
            </a>
        </li>
        <li class="{{ Request::is('jadwal') ? 'active' : '' }}">
            <a href="/Pjadwal/create" id="sidebar-jadwal">
                <i class='bx bxs-calendar'></i>
                <span class="text">Data Jadwal</span>
            </a>
        </li>
        <li class="{{ Request::is('event') ? 'active' : '' }}">
            <a href="/Pkegiatan/create" id="sidebar-event">
                <i class='bx bxs-calendar-event'></i>
                <span class="text">Data Kegiatan</span>
            </a>
        </li>
        <li class="{{ Request::is('laporan') ? 'active' : '' }}">
            <a href="/Padmin/create" id="sidebar-laporan">
                <i class='bx bxs-file'></i>
                <span class="text">Data Admin</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
        <!-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
            </form> -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
                </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<body>
<div class="content-wrapper">
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="switch-mode" hidden>

            <div class="right-section">
                <div class="profile">
                    <div>
                        <h4> {{ $admin->nama }} </h4>
                        <p> {{ $admin->nip }} </p>
                    </div>
                    <a href="#">
                        <img src="{{ asset('/uploads/image/profil_admin-modified.png') }}" alt="">
                    </a>
                </div>
            </div>
            {{-- <div class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">7</span>
            </div> --}}
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        
        @yield('content')
        </div>
        <!-- MAIN -->

    </section>
    <!-- CONTENT -->
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/home.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>