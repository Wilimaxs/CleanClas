@extends('layout.sidebar-siswa')

@section('content')
    <!-- MAIN -->
    <main>
        <ul class="box-info">
            <li>
                <i class='bx bxs-user'></i>
                <span class="text">
                    <h3>Wali Kelas</h3>
                    <p>{{ $identitas[0]['nama_guru'] }}</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-medal'></i>
                <span class="text">
                    <h3>Point</h3>
                    <p>{{ $total }}</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-calendar'></i>
                <span class="text">
                    <h3>Jadwal Selanjutnya</h3>
                    <p>{{ $nama_hari }},{{ $Tglbaru }}</p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <div class="laporan-home">
                <div class="head">
                    <h3>Laporan</h3>
                    <a href="{{ route('laporan-siswa') }}" class="btn-see-all">
                        <span class="text">See all</span>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                            
                        
                        <tr>
                            <td>
                                <p>{{ $item['nama_hari'] }},{{ $item['tanggal'] }}</p>
                            </td>
                            @if ($item['poin'] == 1)
                            <td>
                                <i class='bx bxs-check-circle'></i>
                            </td>
                            <td><span class="status piket">Piket</span></td>
                            @elseif ($item['poin'] == 0)
                            <td>
                                <i class='bx bxs-x-circle'></i>
                            </td>
                            <td><span class="status tidak piket">Tidak Piket</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="leaderboard-home">
                <div class="head">
                    <h3>Leaderboard</h3>
                    <a href="{{ route('lead-sis') }}" class="btn-see-all">
                        <span class="text">See all</span>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
                <ul class="leaderboard-list">
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
