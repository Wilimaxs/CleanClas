@extends('layout.sidebar')

@section('title', 'Data kegiatan')

@section('content')


<form action="{{route('Pkegiatan.store')}}" method="POST" enctype="multipart/form-data">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf

  <section>

    <!-- isian nama -->
    <div class="input-container">
  <div>
    @error('id_keg')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="id_keg">ID Kegiatan</label>
      <input type="text" name="id_keg" value="{{ old('id_keg') }}">
    </div>





  <!-- <div>
    ID kegiatan: <br> (hanya angka)
    <div>
    @error('id_keg')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="id_keg" value="{{ old('id_keg') }}"></div> -->


    <!-- isian nama -->
    <div class="input-container">
  <div>
    @error('nama_keg')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nama_keg">Nama Kegiatan</label>
      <input type="text" name="nama_keg" value="{{ old('nama_keg') }}">
    </div>


<!-- 
  <div>
    Nama Kegiatan:
    <div>
    @error('nama_keg')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="nama_keg" value="{{ old('nama_keg') }}"></div> -->
  
  <!-- isian deskripsi -->
  <div class="input-container">
  <div>
    @error('deskripsi')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="">{{ old('deskripsi') }}</textarea>
    </div>



  <!-- <div>
    Deskripsi: <br> (Jabarkan acara dengan jelas)
    <div>
    @error('deskripsi')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="deskripsi" value="{{ old('deskripsi') }}"></div> -->

    <!-- isian tanggal -->
    <div class="input-container">
  <div>
    @error('tanggal')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="tanggal">Tanggal</label>
      <input type="date" name="tanggal" value="{{ old('tanggal') }}">
    </div>



  <!-- <div>
    Tanggal: 
    <div>
    @error('tanggal')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="date" name="tanggal" value="{{ old('tanggal') }}"></div> -->
 

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
            <option value="{{$h->id}}">{{$h->id}} - {{$h->nama_hari}}</option>
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


   <!-- isian file -->
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
  <div class="send-container">
    <input type="submit" value="create">
  </div>
</form>



<!-- <div class="card-body">
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>Nama Kegiatan</th>
        <th>Deskripsi</th>
        <th>tanggal</th>
        <th>Status</th>
        <th>Hari</th>
        <th>Image</th>
        <th>aksi</th>
      </tr>

      @if(isset($storeData))
        @foreach ($storeData as $k)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->nama_keg }}</td>
            <td>{{ $k->deskripsi }}</td>
            <td>{{ $k->tanggal }}</td>
            <td>{{ $k->status }}</td>
            <td>{{ $k->nama_hari }}</td>
            <td><a href="http://127.0.0.1:8000/{{ $k->image }}">klik disini</a></td>
            <td>
              <a href=""><i class="fas fa-edit"></i></a>
              <a href=""><i class="fas fa-trash-alt" style="color: red;"></i></a>
            </td>
          </tr>
        @endforeach
      @endif
      
    </table>
  </div> -->


  <div class="table-widget">
			<table>
				<caption>
					Data Kegiatan
					<span class="table-row-count"></span>
				</caption>
        <!-- judul -->
				<thead>
					<tr>
          <th>No</th>
          <th>Nama Kegiatan</th>
          <th>Deskripsi</th>
          <th>tanggal</th>
          <th>Status</th>
          <th>Hari</th>
          <th>Image</th>
          <th>aksi</th>
					</tr>
				</thead>

				<tbody id="team-member-rows">
					<!--? rows are generated -->
          @if(isset($storeData))
        @foreach ($storeData as $k)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->nama_keg }}</td>
            <td>{{ $k->deskripsi }}</td>
            <td>{{ $k->tanggal }}</td>
            <td>{{ $k->status }}</td>
            <td>{{ $k->nama_hari }}</td>
            <td><a href="http://127.0.0.1:8000/{{ $k->image }}">klik disini</a></td>
            <td>
            <div style="display: flex; align-items: center;">
                <a href="{{ route('Pkegiatan.edit', $k->id_keg) }}"><i class="fas fa-edit"></i>Edit</a> | 
                <form action="{{ route('Pkegiatan.destroy', $k->id_keg) }}" method="POST" class="delete-form">
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