@extends('layout.sidebar-guru')

@section('content')
    <!-- MAIN -->
    <main>
        <div class="head">
            <img src="/images/award.png" alt="">
            <h3>Kegiatan <em>Sekolah</em></h3>
            <img src="/images/award.png" alt="">
        </div>
        <section class="event">
            <div class="container">
                <div class="event-main">
                    <div class="row">

                        {{-- Event --}}
                        @foreach ( $data as $item)
                            
                        
                        <div class="event-table style-1">

                            {{-- Gambar --}}
                            <div class="event-table-header">
                                <img src="http://127.0.0.1:8000/{{ $item['image'] }}" alt="">
                            </div>

                            {{-- judul kegiatan --}}
                            <h3>{{ $item['nama_keg'] }}</h3>

                            {{-- isi --}}
                            <div class="event-table-body">
                                <p>
                                    {{ $item['deskripsi'] }}
                                </p>

                                {{-- Waktu --}}
                                <div class="btn-event">
                                    <span class="text">Waktu : {{ $item['tanggal'] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection