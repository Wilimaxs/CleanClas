@extends('layout.sidebar')

@section('title', 'Data guru')


@section('content')

<form action="{{ route('Psiswa.update', $post->nis) }}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf
  @method('PUT')

  <section>

    <div  class="input-container">
      <label for="nis">Nis</label>
      <input type="text" disabled value="{{ $post->nis }}" >  
    </div>

  <!-- <div>
    Nis Anda: {{ $post->nis }}
  </div> -->

  <div class="input-container">
  <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nama">Nama</label>
      <input type="text" name="nama" value="{{ old('nama' , $post->nama) }}" />
    </div>

  <!-- <div>
    Nama: <br> (Khusus Huruf) 
    <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="nama" value="{{ old('nama' , $post->nama) }}"></div> -->

  <!-- isian nip -->
<div class="input-container">
  <div>
    @error('nip')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nip">Wali Kelas</label>
      <select class="form-control" name="nip">
    @if(isset($guru))
        @foreach ($guru as $g)
            <option value="{{$g->nip}}">{{$g->nama}}</option>
        @endforeach
    @endif
</select>
    </div>


  <!-- <div>
    Wali Kelas: 
    <div> 
    @error('nip')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div> 
  </div>
  <select class="form-control" name="nip">
    @if(isset($guru))
        @foreach ($guru as $g)
            <option value="{{$g->nip}}">{{$g->nip}} - {{$g->nama}}</option>
        @endforeach
    @endif
</select> -->

<!-- isian kelas -->
<div class="input-container">
  <div>
    @error('id_kelas')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="id_kelas">Kelas</label>
      <select class="form-control" name="id_kelas">
    @if(isset($kls))
        @foreach ($kls as $k)
            <option value="{{$k->id}}">{{$k->nama_kls}}</option>
        @endforeach
    @endif
</select>
    </div>


  <!-- <div>
    Kelas:
    <div>
    @error('id_kelas')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <select class="form-control" name="id_kelas">
    @if(isset($kls))
        @foreach ($kls as $k)
            <option value="{{$k->id}}">{{$k->nama_kls}}</option>
        @endforeach
    @endif
</select> -->


<div class="input-container">
  <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="pass">Password</label>
      <input type="password" name="pass" value="{{ old('pass', $post->pass) }}" />
    </div>



  <!-- <div>
    password: <br> Minimal 1(huruf kecil, huruf besar, angka, dan karakter)
    <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="password" name="pass" value="{{ old('pass', $post->pass) }}"></div> -->


  <div class="input-container">
  <div>
    @error('tlp')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="tlp">Telepon</label>
      <input type="number" name="tlp" value="{{ old('tlp', $post->tlp) }}" />
    </div>


  <!-- <div>
    telepon: <br> (Contoh: "08xxx")
    <div>
    @error('tlp')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="tlp" value="{{ old('tlp', $post->tlp) }}"></div> -->


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