@extends('layout.sidebar')

@section('title', 'Data Siswa')

@section('content')
<form action="{{route('Psiswa.store')}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf

  <section>

  <!-- isian nis -->
  <div class="input-container">
    <div>
      @error('nis')
        <div style="color: red;">{{ $message }}</div>
      @enderror
    </div>
        <label for="nis">NIS</label>
        <input type="number" name="nis" value="{{ old('nis') }}" />
      </div>

  <!-- <div>
    NIS: <br> (Panjang:10)
    <div>
    @error('nis')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="nis" value="{{ old('nis') }}"></div> -->

  <!-- isian nama -->
  <div class="input-container">
  <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nama">Nama</label>
      <input type="text" name="nama" value="{{ old('nama') }}">
    </div>


  <!-- <div>
    Nama: <br> (Khusus Huruf)
    <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="nama" value="{{ old('nama') }}"></div> -->

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
            <option value="{{$g->nip}}">{{$g->nama}}</option>
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
            <option value="{{$k->id}}" class="my-class">{{$k->nama_kls}}</option>
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

<!-- isian password -->
<div class="input-container">
  <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="pass">Password</label>
      <input type="text" name="pass" value="{{ old('pass') }}" />
    </div>


  <!-- <div>
    password: <br> Minimal 1(huruf kecil, huruf besar, angka, dan karakter)
    <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="password" name="pass"></div> -->


  <!-- isian nomor -->
  <div class="input-container">
  <div>
    @error('tlp') 
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="tlp">Telepon</label>
      <input type="number" name="tlp" value="{{ old('tlp') }}" />
    </div>



  <!-- <div>
    telepon: <br> (Contoh: "08xxx")
    <div>
    @error('tlp')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="tlp" value="{{ old('tlp') }}"></div> -->
  </section>
  <div class="send-container">
    <input type="submit" value="create">
  </div>
</form>

 



<!-- tabel siswa -->
<!-- 
  <div class="card-body">
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Wali Kelas</th>
        <th>Kelas</th>
        <th>Password</th>
        <th>Telepon</th>
        <th>Aksi</th>
      </tr>

      @if(isset($siswaWithGuruNames))
        @foreach ($siswaWithGuruNames as $sis)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sis->nis }}</td>
            <td>{{ $sis->nama }}</td>
            <td>{{ $sis->nama_guru }}</td>
            <td>{{ $sis->kelas }}</td>
            <td>{{ $sis->pass }}</td>
            <td>{{ $sis->tlp }}</td>
            <td>
              <a href="{{ route('Psiswa.edit', $sis->nis) }}"><i class="btn btn-seccess mx-2"></i>Edit </a>
              <a href=""><i class="fas fa-trash-alt" style="color: red;"></i>Delete</a>
            </td>
          </tr>
        @endforeach
      @endif
      
    </table>
  </div>
   -->


  <div class="table-widget">
			<table>
				<caption>
					Data Siswa
					<span class="table-row-count"></span>
				</caption>
        <!-- judul -->
				<thead>
					<tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Wali Kelas</th>
            <th>Kelas</th>
            <th>Password</th>
            <th>Telepon</th>
            <th>Aksi</th>
					</tr>
				</thead>

				<tbody id="team-member-rows">
					<!--? rows are generated -->
          @if(isset($siswaWithGuruNames))
        @foreach ($siswaWithGuruNames as $sis)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sis->nis }}</td>
            <td>{{ $sis->nama }}</td>
            <td>{{ $sis->nama_guru }}</td>
            <td>{{ $sis->kelas }}</td>
            <td>{{ $sis->pass }}</td>
            <td>{{ $sis->tlp }}</td>
            <td>
              <!-- <a href="{{ route('Psiswa.edit', $sis->nis) }}"><i class="fas fa-edit"></i>Edit </a>
               -->

               <div style="display: flex; align-items: center;">
                <a href="{{ route('Psiswa.edit', $sis->nis) }}"><i class="fas fa-edit"></i>Edit</a> | 
                <form action="{{ route('Psiswa.destroy', $sis->nis) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <a href="#" onclick="if(confirm('Delete?')) { document.querySelector('.delete-form').submit(); }" class="btn-delete">
                        <i class="fas fa-trash-alt"></i> Delete
                    </a>
                </form>
                </div>
            </td>
          </tr>
        @endforeach
      @endif
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<ul class="pagination">
								<!--? generated pages -->
               

                
							</ul>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
 

@endsection