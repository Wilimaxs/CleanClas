@extends('layout.sidebar-siswa')

@section('content')
    <!-- MAIN -->
    <main>
        <div class="head">
            <img src="/images/award.png" alt="">
            <h3>Jadwal <em>Piket</em></h3>
            <img src="/images/award.png" alt="">
        </div>
        <section class="jadwal">
            <div class="container">
                <div class="jadwal-main">
                    <div class="row">

                        <!-- basic table start -->

                        <div class="jadwal-piket style-1">
                            <div class="piket-table-header">
                                <h3>Senin</h3>
                            </div>
                            <div class="piket-hari-siswa">
                                <ul class="piket">
                                    @foreach ( $senin as $item)
                                    {{-- nama yang piket senin --}}
                                    <li>{{ $item['nama'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                       
                        <!-- basic table end -->

                        <!-- standard table start -->
                        <div class="jadwal-piket style-2">
                            <div class="piket-table-header">
                                <h3>Selasa</h3>
                            </div>
                            <div class="piket-hari-siswa">
                                <ul class="piket">
                                @foreach ( $selasa as $item)
                                    {{-- nama yang piket selasa --}}
                                    <li>{{ $item['nama'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- standard table end -->

                        <!-- premium table start -->
                        <div class="jadwal-piket style-3">
                            <div class="piket-table-header">
                                <h3>Rabu</h3>
                            </div>
                            <div class="piket-hari-siswa">
                                <ul class="piket">
                                @foreach ( $rabu as $item)
                                    {{-- nama yang piket rabu --}}
                                    <li>{{ $item['nama'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- premium table end -->

                        <!-- premium table start -->
                        <div class="jadwal-piket style-4">
                            <div class="piket-table-header">
                                <h3>Kamis</h3>
                            </div>
                            <div class="piket-hari-siswa">
                                <ul class="piket">
                                @foreach ( $kamis as $item)
                                    {{-- nama yang piket kamis --}}
                                    <li>{{ $item['nama'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- premium table end -->

                        <!-- premium table start -->
                        <div class="jadwal-piket style-5">
                            <div class="piket-table-header">
                                <h3>Jum'at</h3>
                            </div>
                            <div class="piket-hari-siswa">
                                <ul class="piket">
                                @foreach ( $jumat as $item)
                                    {{-- nama yang piket jumat --}}
                                    <li>{{ $item['nama'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- premium table end -->

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
