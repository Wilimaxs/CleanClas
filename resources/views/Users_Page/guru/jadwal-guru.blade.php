@extends('layout.sidebar-guru')

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


                        {{-- nama yang piket senin --}}
                        <div class="jadwal-piket style-1">
                            <div class="piket-table-header">
                                <h3>Senin</h3>
                            </div>
                            <div class="piket-hari-guru">
                                <ul class="piket">

                                    {{-- anggota 1 senin --}}
                                    <form action="{{ route('jadwal-cek') }}" method="post">
                                    @csrf
                                    @foreach($data1 as $item)
                                    <li>
                                        <label for="senin">{{$item['nama']}}</label>
                                        <input type="hidden" name="nip[]" value="{{ $item['nip'] }}">
                                        <input type="hidden" name="nis[]" value="{{ $item['nis'] }}">

                                        <div class="radio-input">

                                            {{-- hadir piket --}}
                                            <fieldset>
                                            <input checked="" value="1" name="nilai[{{ $loop->index }}]"
                                                id="{{$item['nama']}}_color-1" type="radio">
                                            <label for="{{$item['nama']}}_color-1">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 12L10.2426 16.2426L18.727 7.75732" id="Vector">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>

                                            {{-- tidak hadir piket --}}
                                            <input value="0" name="nilai[{{ $loop->index }}]" id="{{$item['nama']}}_color-2"
                                                type="radio">
                                            <label for="{{$item['nama']}}_color-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 6l12 12m0-12L6 18" id="Vector"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>
                                            </fieldset>
                                        </div>
                                    </li>
                                    @endforeach
                                    <button class="btn-submit" id="btn-submit-senin" style="cursor: pointer;" {{ ($buttonStatus1== 'enabled' && $btnday == 'enabled') ? '' : 'disabled' }}>
                                        <span class="text">Submit</span>
                                    </button>
                                    </form>
                                </ul>
                            </div>
                        </div>


                        {{-- nama yang piket selasa --}}
                        <div class="jadwal-piket style-2">
                            <div class="piket-table-header">
                                <h3>Selasa</h3>
                            </div>
                            <div class="piket-hari-guru">
                                <ul class="piket">
                                    <!-- Data Piket Selasa -->
                                    <form action="{{ route('jadwal-cek') }}" method="post">
                                    @csrf
                                    @foreach($data2 as $item)
                                    <li><label for="selasa">{{$item['nama']}}</label>
                                        <input type="hidden" name="nip[]" value="{{ $item['nip'] }}">
                                        <input type="hidden" name="nis[]" value="{{ $item['nis'] }}">
                                        <div class="radio-input">

                                        <!-- Cek Piket -->
                                        <fieldset>
                                            <input checked="" value="1" name="nilai[{{ $loop->index }}]"
                                                id="{{$item['nama']}}_color-1" type="radio">
                                            <label for="{{$item['nama']}}_color-1">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 12L10.2426 16.2426L18.727 7.75732"
                                                                    id="Vector">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>
                                            <input value="0" name="nilai[{{ $loop->index }}]" id="{{$item['nama']}}_color-2"
                                                type="radio">
                                            <label for="{{$item['nama']}}_color-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 6l12 12m0-12L6 18" id="Vector"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>
                                            </fieldset>
                                        </div>
                                    </li>
                                    @endforeach

                                    <button class="btn-submit" id="btn-submit-senin" style="cursor: pointer;" {{ ($buttonStatus2== 'enabled' && $btnday == 'enabled') ? '' : 'disabled' }}>
                                        <span class="text">Submit</span>
                                    </button>
                                    </form>
                                </ul>
                            </div>
                        </div>


                        {{-- nama yang piket rabu --}}
                        <div class="jadwal-piket style-3">
                            <div class="piket-table-header">
                                <h3>Rabu</h3>
                            </div>
                            <div class="piket-hari-guru">
                                <ul class="piket">
                                    <!-- Data Piket Rabu -->
                                    <form action="{{ route('jadwal-cek') }}" method="post">
                                    @csrf
                                    @foreach($data3 as $item)
                                    <li><label for="rabu" >{{$item['nama']}}</label>
                                        <input type="hidden" name="nip[]" value="{{ $item['nip'] }}">
                                        <input type="hidden" name="nis[]" value="{{ $item['nis'] }}">
                                        <div class="radio-input">

                                        <fieldset>
                                            <input checked="" value="1" name="nilai[{{ $loop->index }}]"
                                                id="{{$item['nama']}}_color-1" type="radio">
                                            <label for="{{$item['nama']}}_color-1">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 12L10.2426 16.2426L18.727 7.75732"
                                                                    id="Vector">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>

                                            <input value="0" name="nilai[{{ $loop->index }}]"
                                                id="{{$item['nama']}}_color-2" type="radio">
                                            <label for="{{$item['nama']}}_color-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 6l12 12m0-12L6 18" id="Vector"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>
                                            </fieldset>
                                        </div>
                                    </li>
                                @endforeach
                                   
                                    <button class="btn-submit" id="btn-submit-senin" style="cursor: pointer;" {{ ($buttonStatus3== 'enabled' && $btnday == 'enabled') ? '' : 'disabled' }}>
                                        <span class="text">Submit</span>
                                    </button>
                                    </form>
                                </ul>
                            </div>
                        </div>


                        {{-- nama yang piket kamis --}}
                        <div class="jadwal-piket style-4">
                            <div class="piket-table-header">
                                <h3>Kamis</h3>
                            </div>
                            <div class="piket-hari-guru">
                                <ul class="piket">
                                    <!-- Data Piket Kamis -->
                                    <form action="{{ route('jadwal-cek') }}" method="post">
                                    @csrf
                                    @foreach($data4 as $item)
                                    <li><label for="rabu" >{{$item['nama']}}</label>
                                        <input type="hidden" name="nip[]" value="{{ $item['nip'] }}">
                                        <input type="hidden" name="nis[]" value="{{ $item['nis'] }}">
                                        <div class="radio-input">
                                        <fieldset>
                                            <input checked="" value="1" name="nilai[{{ $loop->index }}]"
                                                id="{{$item['nama']}}_color-1" type="radio">
                                            <label for="{{$item['nama']}}_color-1">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 12L10.2426 16.2426L18.727 7.75732"
                                                                    id="Vector">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>

                                            <input value="0" name="nilai[{{ $loop->index }}]" id="{{$item['nama']}}_color-2"
                                                type="radio">
                                            <label for="{{$item['nama']}}_color-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 6l12 12m0-12L6 18" id="Vector"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>
                                            </fieldset>
                                        </div>
                                    </li>
                                    @endforeach

                                    <button class="btn-submit" id="btn-submit-senin" style="cursor: pointer;" {{ ($buttonStatus4== 'enabled' && $btnday == 'enabled') ? '' : 'disabled' }}>
                                        <span class="text">Submit</span>
                                    </button>
                                    </form>
                                </ul>
                            </div>
                        </div>



                        {{-- nama yang piket jumat --}}
                        <div class="jadwal-piket style-5">
                            <div class="piket-table-header">
                                <h3>Jum'at</h3>
                            </div>
                            <div class="piket-hari-guru">
                                <ul class="piket">
                                    <!-- Data Hari Jumat -->
                                    <form action="{{ route('jadwal-cek') }}" method="post">
                                    @csrf
                                    @foreach($data5 as $item)
                                    <li><label for="rabu" >{{$item['nama']}}</label>
                                        <input type="hidden" name="nip[]" value="{{ $item['nip'] }}">
                                        <input type="hidden" name="nis[]" value="{{ $item['nis'] }}">
                                        
                                        <div class="radio-input">
                                        <fieldset>
                                            <input checked="" value="1" name="nilai[{{ $loop->index }}]"
                                                id="{{$item['nama']}}_color-1" type="radio">
                                            <label for="{{$item['nama']}}_color-1">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 12L10.2426 16.2426L18.727 7.75732"
                                                                    id="Vector">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>

                                            <input value="0" name="nilai[{{ $loop->index }}]" id="{{$item['nama']}}_color-2"
                                                type="radio">
                                            <label for="{{$item['nama']}}_color-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Interface / Check">
                                                                <path stroke-linejoin="round" stroke-linecap="round"
                                                                    stroke-width="2" stroke="#ffffff"
                                                                    d="M6 6l12 12m0-12L6 18" id="Vector"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </label>
                                            </fieldset>
                                        </div>
                                    </li>
                                    @endforeach

                                    <button class="btn-submit" id="btn-submit-senin" style="cursor: pointer;" {{ ($buttonStatus5== 'enabled' && $btnday == 'enabled') ? '' : 'disabled' }}>
                                        <span class="text">Submit</span>
                                    </button>
                                    </form>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
