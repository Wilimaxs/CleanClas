@extends('layout.sidebar-guru')

@section('content')
    <!-- MAIN -->
    <main>
        <div class="head">
            <img src="/images/award.png" alt="">
            <h3>Leaderboard</h3>
            <img src="/images/award.png" alt="">
        </div>
        <div class="table-data">
            <div class="leader">
                <ul class="leader-list">
                    {{-- juara 1 --}}
                    @foreach ( $leader as $item)
                    
                    <li class="juara1">
                        <i>
                            <img src="/images/{{ $loop->index + 1 }}.png" alt="">
                        </i>
                        <p>Kelas {{ $item['nama_kls'] }}</p>
                        <a class="btn-leader">
                            <span class="text">{{ $item['total_poin'] }} Point</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </main>
@endsection
