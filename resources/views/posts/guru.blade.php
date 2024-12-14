@extends('layout.sidebar')

@section('title', 'Data guru')


@section('content')
<form action="{{route('posts.store')}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf

  <!-- simple form -->
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
  </div> -->
  <!-- <div><input type="number" name="nip" value="{{ old('nip') }}"></div> -->

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
  </div> -->
  <!-- <div><input type="text" name="nama" value="{{ old('nama') }}"></div> -->

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
  <!-- Kirim Data -->
  <div class="send-container">
    <input type="submit" value="create">
  </div>

</form>

<!-- tabel data guru -->
<!-- <div class="card-body">
    <table class="table table-bordered">
      <tr >
        <th>No</th>
        <th>NIP</th>
        <th>Nama Guru</th>
        <th>Telepon (Whatsapp)</th>
        <th>Password</th>
        <th>aksi</th>
      </tr>

      @if(isset($guru))
        @foreach ($guru as $g)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $g->nip }}</td>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->tlp }}</td>
            <td>{{ $g->pass }}</td>
            <td>
              <div>
              <a href="{{ route('posts.edit', $g->nip) }}"><i class="fas fa-edit"></i>Edit </a>
              <form action="{{ route('posts.destroy', $g->nip) }}" method="POST" type="button" onsubmit="return confirm('Delete?')">
              @csrf
              @method('DELETE')
              <button class="fas fa-trash-alt" style="color: red;">Delete</button>
              </form>
              </div>
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
          Data Guru
					<span class="table-row-count"></span>
				</caption>
        <!-- judul -->
				<thead>
					<tr>
						<th>No</th>
						<th>NIP</th>
						<th>Nama Guru</th>
						<th>Telepon (WA)</th>
						<th>Password</th>
						<th>aksi</th>
					</tr>
				</thead>

				<tbody id="team-member-rows">
					<!--? rows are generated -->
          @if(isset($guru))
        @foreach ($guru as $g)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $g->nip }}</td>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->tlp }}</td>
            <td>{{ $g->pass }}</td>
            <td>
              <!-- <div style="display: flex; align-items: center;">
              <form action="{{ route('posts.destroy', $g->nip) }}" method="POST" type="button" onsubmit="return confirm('Delete?')">
              @csrf
              @method('DELETE')
                <button type="submit" class="btn-delete" style="cursor: pointer;">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
                </form>
                <a href="{{ route('posts.edit', $g->nip) }}" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit 
                  </a>
                    
              
              </div> -->
              <div style="display: flex; align-items: center;">
                <a href="{{ route('posts.edit', $g->nip) }}"><i class="fas fa-edit"></i>Edit</a> | 
                <form action="{{ route('posts.destroy', $g->nip) }}" method="POST" class="delete-form">
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