@extends('layout.sidebar-siswa')

@section('content')
    <!-- MAIN -->
    <main>
        <div class="head">
            <img src="/images/award.png" alt="">
            <h3>Laporan</h3>
            <img src="/images/award.png" alt="">

        </div>
        <div class="table-laporan">
            <div class="laporan">
                <table>

                    {{-- header baris --}}
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- laporan harian --}}
                        @foreach ( $laporan as $item )
                            
                        
                        <tr>
                            <td>
                                <p>{{ $item['nama_hari'] }}, {{ $item['tanggal']}}</p>
                            </td>
                            @if ($item['poin'] == 0)
                            <td>
                                <i class='bx bxs-x-circle'></i>
                            </td>
                            <td><span class="status tidak piket">Tidak Piket</span></td>
                            @elseif ($item['poin'] == 1)
                            <td>
                                <i class='bx bxs-check-circle'></i>
                            </td>
                            <td><span class="status piket">piket</span></td>
                            @endif
                        </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
