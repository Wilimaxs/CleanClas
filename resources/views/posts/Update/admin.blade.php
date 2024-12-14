@extends('layout.sidebar')

@section('title', 'Data guru')


@section('content')

@section('content')
<form action="{{route('Padmin.update', $post->nip)}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf
  @method('PUT')

  <section>

  <div  class="input-container">
      <label for="nip">Nip</label>
      <input type="text" disabled value="{{ $post->nip }}" >  
    </div>

  <!-- <div>
    Nip: {{ $post->nip }}
  </div> -->

  <div class="input-container">
  <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nama">Nama</label>
      <input type="text" name="nama" value="{{ old('nama', $post->nama) }}" />
    </div>

  <!-- <div>
    Nama: <br> (khusus huruf)
    <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="nama" value="{{ old('nama', $post->nama) }}"></div> -->

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
    Telepon: <br> (Contoh: "08xxx")
    <div>
    @error('tlp')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="tlp" value="{{ old('tlp', $post->tlp) }}"></div> -->

  <div class="input-container">
  <div>
    @error('alamat')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="alamat">Telepon</label>
      <input type="text" name="alamat" value="{{ old('alamat', $post->alamat) }}" />
    </div>


  <!-- <div>
    Alamat: 
    <div>
    @error('alamat')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div> 
  </div>
  <div><input type="text" name="alamat" value="{{ old('alamat', $post->alamat) }}"></div> -->


  <div class="input-container">
  <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="pass">Password</label>
      <input type="password" name="pass" value="{{ $post->pass }}" />
    </div>


  <!-- <div>
    Password: <br> Minimal 1(huruf kecil, huruf besar, angka, dan karakter)
    <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="password" name="pass" value="{{ $post->pass }}"></div> -->
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