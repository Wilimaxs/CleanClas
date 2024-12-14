@extends('layout.sidebar')

@section('title', 'Data guru')


@section('content')

<form action="{{route('Pkegiatan.update', $post->id_keg)}}" method="POST" enctype="multipart/form-data">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf
  @method('PUT')

  <section>


  <div  class="input-container">
      <label for="id_keg">Id_Kegiatan</label>
      <input type="text" disabled value="{{ $post->id_keg}}" >  
    </div>


  <!-- <div>
    Id Kegiatan: {{ $post->id_keg}}
  </div> -->
  
  <div class="input-container">
  <div>
    @error('nama_keg')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nama_keg">Nama</label>
      <input type="text" name="nama_keg" value="{{ old('nama_keg', $post->nama_keg) }}" />
    </div>

  <!-- <div>
    Nama Kegiatan:
    <div>
    @error('nama_keg')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="nama_keg" value="{{ old('nama_keg', $post->nama_keg) }}"></div> -->


  <div class="input-container">
  <div>
    @error('deskripsi')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="">{{ old('deskripsi', $post->deskripsi) }}</textarea>
    </div>

  <!-- <div>
    Deskripsi: <br> (Jabarkan acara dengan jelas)
    <div>
    @error('deskripsi')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="deskripsi" value="{{ old('deskripsi', $post->deskripsi) }}"></div> -->


<!-- isian tanggal -->
<div class="input-container">
  <div>
    @error('tanggal')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="tanggal">Tanggal</label>
      <input type="date" name="tanggal" value="{{ old('tanggal', $post->tanggal) }}">
    </div>

  <!-- <div>
    Tanggal: 
    <div>
    @error('tanggal')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="date" name="tanggal" value="{{ old('tanggal', $post->tanggal) }}"></div> -->


     <!-- isian status -->
     <div class="input-container">
     <label for="sts">Status:</label>
     <select name="status" id="sts">
    <option value="aktif">Aktif</option>
    <option value="nonaktif">Non Aktif</option>
  </select>
    </div>


  <!-- <label for="sts">Status:</label>
  <select name="status" id="sts">
    <option value="aktif">Aktif</option>
    <option value="nonaktif">Non Aktif</option>
  </select> -->


     <!-- isian hari -->
     <div class="input-container">
      <label for="hari">Hari</label>
      <select class="form-control" name="hari">
    @if(isset($hari))
        @foreach ($hari as $h)
            <option value="{{$h->id}}">{{$h->nama_hari}}</option>
        @endforeach
    @endif
</select>
    </div>

  <!-- <div>Hari:</div>
  <select class="form-control" name="hari">
    @if(isset($hari))
        @foreach ($hari as $h)
            <option value="{{$h->id}}">{{$h->id}} - {{$h->nama_hari}}</option>
        @endforeach
    @endif
</select> -->

<div class="input-container">
  <div>
    @error('image')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="file">Pilih File</label>
      <input type="file" name="image" id="file" class="form-control">
    </div>


<!-- <div>
    <label for="file">
      Pilih File: <br> (Gambar harus ada)
      <div>
    @error('image')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
    </label> 
    <input type="file" name="image" id="file" class="form-control">
  </div> -->

  </section>
  <div class="flat">
  <div class="back-container">
  <input type="button" value="Back" onclick="window.location.href='{{ url()->previous() }}'" class="btn btn-secondary">
  </div>
  <div class="send-container">
    <input type="submit" value="Update">
  </div>
   
  </div>
@endsection