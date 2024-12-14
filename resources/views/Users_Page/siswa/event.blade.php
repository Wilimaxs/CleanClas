@extends('layout.sidebar-siswa')

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
                        @foreach ($data as $item)
                            
                        
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

<!-- 
                        <div class="event-table style-1">
                            <div class="event-table-header">
                                <img src="assets/images/kebersihankelas.jpg" alt="">
                            </div>
                            <h3>Wujudkan Kebersihan Kelas yang Sehat</h3>
                            <div class="event-table-body">
                                <p>
                                    Jaga kebersihan kelas untuk kesehatan dan kenyamanan. Dengan lingkungan bersih, siswa
                                    dapat belajar dengan optimal. Ayo bersama-sama rawat kebersihan kelas! Dengan ruang
                                    belajar bersih, kita ciptakan lingkungan nyaman dan sehat. Mari bergandengan tangan
                                    menjaga kebersihan untuk pembelajaran yang lebih baik dan lebih menyenangkan bagi semua!
                                </p>
                                <div class="btn-event">
                                    <span class="text">Waktu : 24 April 2024</span>
                                </div>
                            </div>
                        </div>


                        <div class="event-table style-1">
                            <div class="event-table-header">
                                <img src="assets/images/sampah.jpg" alt="">
                            </div>
                            <h3>Kreasi Mengubah Limbah menjadi Karya</h3>
                            <div class="event-table-body">
                                <p>
                                    Mari berpartisipasi dalam gerakan lingkungan dengan membuat sesuatu dari sampah! Dari
                                    kerajinan tangan hingga karya seni, setiap kreasi membantu menyelamatkan lingkungan.
                                    Mulailah dengan mengumpulkan sampah dan berkreasi. Bersama, kita bisa mengurangi limbah
                                    dan menciptakan dunia yang lebih berkelanjutan!
                                </p>
                                <div class="btn-event">
                                    <span class="text">Waktu : 26 April 2024</span>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
