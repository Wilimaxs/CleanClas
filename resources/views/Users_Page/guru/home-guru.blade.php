@extends('layout.sidebar-guru')

@section('content')
    <!-- MAIN -->
    <main>

        {{-- 3 kotak diatas --}}
        <ul class="box-info">
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>Siswa</h3>
                    <p>{{ $count }}</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-door-open'></i>
                <span class="text">
                    <h3>Kelas</h3>
                    <p>{{ $nama_kelas }}</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-medal'></i>
                <span class="text">
                    <h3>Point</h3>
                    <p>{{ $totalPoin }}</p>
                </span>
            </li>
        </ul>

        {{-- tabel-tabel --}}
        <div class="table-data">

            {{-- tabel laporan --}}
            <div class="laporan-home">

                {{-- header dan title tabel leaderboard --}}
                <div class="head">
                    <h3>Laporan</h3>
                    <a href="{{ route('laporan') }}" class="btn-see-all">
                        <span class="text">See all</span>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Point</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- list laporan siswa dan pointnya --}}
                        @foreach ( $lapor as $item )
                            
                        <tr>
                            <td>
                                <p>{{ $item['nis'] }}</p>
                            </td>
                            <td>
                                <p>{{ $item['nama'] }}</p>
                            </td>
                            <td>
                                <a class="btn-laporan">
                                    <span class="text">{{ $item['total_poin'] }}</span>

                                </a>
                            </td>
                        </tr>
                        @endforeach

                        {{-- list laporan siswa dan pointnya --}}
                       
                    </tbody>
                </table>
            </div>

            {{-- tabel leaderboard --}}
            <div class="leaderboard-home">

                {{-- header dan title tabel leaderboard --}}
                <div class="head">
                    <h3>Leaderboard</h3>
                    <a href="{{ route('leaderboard') }}" class="btn-see-all">
                        <span class="text">See all</span>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
                <ul class="leaderboard-list">

                    {{-- list leaderboard kelas dan pointnya --}}
                    @foreach ( $leader as $item )
                        
                    <li class="juara1">
                        <i>
                            <img src="/images/{{ $loop->index + 1 }}.png" alt="">
                        </i>
                        <p>Kelas {{ $item['nama_kls'] }}</p>
                        <a class="btn-leaderboard">
                            <span class="text">{{ $item['total_poin'] }} point</span>
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </main>

@endsection
