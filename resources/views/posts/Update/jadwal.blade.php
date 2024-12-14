@extends('layout.sidebar')

@section('title', 'Data guru')


@section('content')

<form action="{{route('Pjadwal.update', $post->id_jadwal)}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf
  @method('PUT')

  <section>
  <div  class="input-container">
      <label for="id_jadwal">Id_Jadwal</label>
      <input type="text" disabled value=" {{ $post->id_jadwal }}" >  
    </div>

  <!-- <div>
    {{ $post->id_jadwal }}
  </div> -->


  <div  class="input-container">
      <label for="nama">Nama Siswa</label>
      <input type="text" disabled value=" {{ $nama->nama }}" >  
    </div>


    <!-- <div>
      Nama Siswa: {{ $nama->nama }}
    </div> -->


    <div class="input-container">
      <label for="id_piket">Hari Piket:</label>
      <select class="form-control" name="hari">
    @if(isset($hari))
        @foreach ($hari as $h)
            <option value="{{$h->id}}">{{$h->nama_hari}}</option>
        @endforeach
    @endif
</select>
    </div>

  <!-- <div>Hari Piket: </div>
  <select class="form-control" name="hari">
    @if(isset($hari)) 
        @foreach ($hari as $h)
            <option value="{{$h->id}}">{{$h->id}} - {{$h->nama_hari}}</option>
        @endforeach
    @endif
</select> -->

</section>
<div class="flat">
  <div class="back-container">
  <input type="button" value="Back" onclick="window.location.href='{{ url()->previous() }}'" class="btn btn-secondary">
  </div>
  <div class="send-container">
    <input type="submit" value="Update">
  </div>
  </div>
</form>


@endsection