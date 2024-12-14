@extends('layout.sidebar-guru')

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
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Point</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- list nama-nama siswa --}}
                        @foreach ( $data as $item )
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
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
