@extends('layout.sidebar')

@section('title', 'Data admin')


@section('content')
<form action="{{route('Padmin.store')}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf
  <section>

      <!-- isian nip -->
      <div class="input-container">
  <div>
    @error('nip')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nip">NIP</label>
      <input type="number" name="nip" value="{{ old('nip') }}" />
    </div>
  
  <!-- <div>
    NIP: <br> (Panjang:18)
    <div>
    @error('nip')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="nip" value="{{ old('nip') }}"></div> -->


  <!-- isian nama -->
  <div class="input-container">
  <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="nama">Nama</label>
      <input type="text" name="nama" value="{{ old('nama') }}" />
    </div>


  <!-- <div>
    Nama: <br> (khusus huruf)
    <div>
    @error('nama')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="nama" value="{{ old('nama') }}"></div> -->

  <!-- isian telepon -->
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
    Telepon: <br> (Contoh: "08xxx")
    <div>
    @error('tlp')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="number" name="tlp" value="{{ old('tlp') }}"></div> -->


  <!-- isian alamat -->
  <div class="input-container">
  <div>
    @error('alamat')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="alamat">Alamat</label>
      <input type="text" name="alamat" value="{{ old('alamat') }}" />
    </div>

  <!-- <div>
    Alamat: 
    <div>
    @error('alamat')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div>
  <div><input type="text" name="alamat" value="{{ old('alamat') }}"></div> -->

  <!-- isian Password -->
  <div class="input-container">
  <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
      <label for="pass">Password</label>
      <input type="text" name="pass" />
    </div>

  <!-- <div>
  Password: <br> Minimal 1(huruf kecil, huruf besar, angka, dan karakter)
    <div>
    @error('pass')
      <div style="color: red;">{{ $message }}</div>
    @enderror
  </div>
  </div> 
  <div><input type="password" name="pass"></div> -->

  </section>
  <div class="send-container">
    <input type="submit" value="create">
  </div>
</form>

<!-- <div class="card-body">
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Password</th>
        <th>aksi</th>
      </tr>

      @if(isset($admin12))
        @foreach ($admin12 as $a)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $a->nip }}</td>
            <td>{{ $a->nama }}</td>
            <td>{{ $a->tlp }}</td>
            <td>{{ $a->alamat }}</td>
            <td>{{ $a->pass }}</td>
            <td>
              <a href=""><i class="fas fa-edit"></i></a>
              <a href=""><i class="fas fa-trash-alt" style="color: red;"></i></a>
            </td>
          </tr>
        @endforeach
      @endif
      
    </table>
  </div> -->






    <!-- tabel example -->
    <div class="table-widget">
			<table>
				<caption>
					Data Admin
					<span class="table-row-count"></span>
				</caption>
        <!-- judul -->
				<thead>
					<tr>
          <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Password</th>
        <th>aksi</th>
					</tr>
				</thead>

				<tbody id="team-member-rows">
					<!--? rows are generated -->
          @if(isset($admin12))
        @foreach ($admin12 as $a)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $a->nip }}</td>
            <td>{{ $a->nama }}</td> 
            <td>{{ $a->tlp }}</td>
            <td>{{ $a->alamat }}</td>
            <td>{{ $a->pass }}</td>
            <td>
            <div style="display: flex; align-items: center;">
                <a href="{{ route('Padmin.edit', $a->nip) }}"><i class="fas fa-edit"></i>Edit</a> | 
                <form action="{{ route('Padmin.destroy', $a->nip) }}" method="POST" class="delete-form">
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