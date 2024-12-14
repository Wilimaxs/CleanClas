@extends('layout.sidebar')

<!-- get dummy data from controler or route  -->
@section('title', 'Data Jadwal')

<!-- get dummy data from controler or route  -->
@section('content')

<form action="{{route('Pjadwal.store')}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf

  <section>

  <!-- isian ID -->
  <div class="input-container">
    <div>
      @error('id')
        <div style="color: red;">{{ $message }}</div>
      @enderror
    </div>
        <label for="id">ID</label>
        <input type="number" name="id" value="{{ old('id') }}" />
      </div>


  <!-- <div>
    ID: <br> (Hanya Angka)
    <div>
    @error('id')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="id" value="{{ old('id') }}"></div> -->

<!-- isian nama siswa-->
  <div class="input-container">
      <label for="nis">Nama Siswa</label>
      <select class="form-control" name="nis">
    @if(isset($siswa))
        @foreach ($siswa as $s)
            <option value="{{$s->nis}}">{{$s->nis}} - {{$s->nama}}</option>
        @endforeach
    @endif
</select>
    </div>



  <!-- <div>Nama Siswa: </div>
  <select class="form-control" name="nis">
    @if(isset($siswa))
        @foreach ($siswa as $s)
            <option value="{{$s->nis}}">{{$s->nis}} - {{$s->nama}}</option>
        @endforeach
    @endif
</select> -->


<!-- isian Hari Piket-->
<div class="input-container">
      <label for="id_piket">Hari Piket:</label>
      <select class="form-control" name="hari">
    @if(isset($hari))
        @foreach ($hari as $h)
            <option value="{{$h->id}}">{{$h->id}} - {{$h->nama_hari}}</option>
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
  <div class="send-container">
    <input type="submit" value="create">
  </div>
</form>

 
<!-- <div class="card-body">
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Wali Kelas</th>
        <th>Hari Piket</th>
        <th>Kelas</th>
        <th>aksi</th>
      </tr>

      @foreach ($jadwalWithKet as $jadwal)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $jadwal->nama_siswa }}</td>
        <td>{{ $jadwal->nama_guru }}</td>
        <td>{{ $jadwal->hari }}</td>
        <td>{{ $jadwal->nama_kelas }}</td>
        <td>
        <a href="{{ route('Pjadwal.edit', $jadwal->id_jadwal) }}"><i class="btn btn-seccess mx-2"></i>Edit </a>
              <a href=""><i class="fas fa-trash-alt" style="color: red;"></i>Delete</a>
            </td>
    </tr>
@endforeach
      
    </table>
  </div> -->
  


  <div class="table-widget">
			<table>
				<caption>
					Data Jadwal
					<span class="table-row-count"></span>
				</caption>
        <!-- judul -->
				<thead>
					<tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Wali Kelas</th>
            <th>Hari Piket</th>
            <th>Kelas</th>
            <th>aksi</th>
					</tr>
				</thead>

				<tbody id="team-member-rows">
					<!--? rows are generated -->
          @foreach ($jadwalWithKet as $jadwal)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $jadwal->nama_siswa }}</td>
        <td>{{ $jadwal->nama_guru }}</td>
        <td>{{ $jadwal->hari }}</td>
        <td>{{ $jadwal->nama_kelas }}</td>
        <td>
        <div style="display: flex; align-items: center;">
                <a href="{{ route('Pjadwal.edit', $jadwal->id_jadwal) }}"><i class="fas fa-edit"></i>Edit</a> | 
                <form action="{{ route('Pjadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="delete-form">
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