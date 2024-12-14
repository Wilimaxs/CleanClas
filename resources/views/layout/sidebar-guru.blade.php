<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- My CSS -->
    @vite(['resources/css/animated.css', 'resources/css/owl.css', 'resources/css/fontawesome.css'])
    <!-- <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css"> -->
    @vite(['resources/css/user/template-home.css'])
    @vite(['resources/css/user/template-laporan.css'])
    @vite(['resources/css/user/template-leaderboard.css'])
    @vite(['resources/css/user/template-jadwal.css'])
    @vite(['resources/css/user/template-event.css'])
    <!-- <link rel="stylesheet" href="assets/css/template-home.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/template-laporan.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/template-leaderboard.css">
    <link rel="stylesheet" href="assets/css/template-jadwal.css">
    <link rel="stylesheet" href="assets/css/template-event.css"> -->
<!-- ini JSnya -->
@vite(['resources/js/user/owl-carousel.js', 'resources/js/user/animation.js', 'resources/js/user/imagesloaded.js', 'resources/js/user/custom.js', 'resources/js/user/home.js'])

    {{-- font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Righteous&display=swap"
        rel="stylesheet">

    <title>CleanClass</title>
    <link rel="icon" href="assets/images/icon.ico">
</head>

<!-- SIDEBAR -->
<section id="sidebar">
    <a class="brand">
        <img src="/images/started.png" alt="">
        <span class="text">CleanClass</span>
    </a>
    <ul class="side-menu top">
        <li class="{{ Request::is('home-guru') ? 'active' : '' }}">
            <a href="{{ route('home') }}" id="sidebar-guru">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Home</span>
            </a>
        </li>
        <li class="{{ Request::is('leaderboard-guru') ? 'active' : '' }}">
            <a href="{{ route('leaderboard') }}" id="sidebar-leaderboard-guru">
                <i class='bx bx-trophy'></i>
                <span class="text">Leaderboard</span>
            </a>
        </li>
        <li class="{{ Request::is('jadwal-guru') ? 'active' : '' }}">
            <a href="{{ route('jadwal') }}" id="sidebar-jadwal-guru">
                <i class='bx bxs-calendar'></i>
                <span class="text">Jadwal</span>
            </a>
        </li>
        <li class="{{ Request::is('event-guru') ? 'active' : '' }}">
            <a href="{{ route('kegiatan') }}" id="sidebar-event-guru">
                <i class='bx bxs-calendar-event'></i>
                <span class="text">Kegiatan</span>
            </a>
        </li>
        <li class="{{ Request::is('laporan-guru') ? 'active' : '' }}">
            <a href="{{ route('laporan') }}" id="sidebar-laporan-guru">
                <i class='bx bxs-file'></i>
                <span class="text">Laporan</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
        <form id="logout-form" action="{{ route('logout-guru') }}" method="POST" style="display: none;">
            @csrf
            </form>
                <!-- <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
                </a> -->
            <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<body>
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="switch-mode" hidden>

            <div class="right-section">
                <div class="profile">
                    <div>
                        <h4>{{ $guru->nama }}</h4>
                        <p>NIP. {{ $guru->nip }}</p>
                    </div>
                    <a>
                        <img src="/images/teacher.png">
                    </a>
                </div>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        @yield('content')
        <!-- MAIN -->

    </section>
    <!-- CONTENT -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="assets/js/home.js"></script> -->
    <!-- <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
