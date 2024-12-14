<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\kegiatan;
use App\Models\kelas;
use App\Models\nilai;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostuserController extends Controller
{
    public function menu(){
        if (session('guru')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('home');
        }
        return view('Users_Page.login-guru');
    }

    public function loginguru(request $request)
    {

        $credential = [
            'nip' => $request->nip,
            'password' => $request->pass,
        ];

        
        $guru = guru::where('nip', $credential['nip'])->first();
        // dd($guru);
        if ($guru && $guru->password == $credential['password']) {
            session(['guru' => $guru]); // Simpan data admin ke dalam sesi
    
            return redirect()->route('home');
        } else {
            
            return back()->with('error', 'NIP atau Password tidak sesuai');
        }
    }

    public function home(request $request){
        if (!session('guru')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('menu');
        }
        $guru = session('guru');
        // dd($guru);
        $count = Siswa::where('nip', $guru['nip'])->count('nis');
        $nama_kelas = Siswa::where('siswas.nip', '=', $guru['nip'])
        ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        ->pluck('kelas.nama_kls')
        ->first();

        $totalPoin = Nilai::join('siswas', 'nilais.nis', '=', 'siswas.nis')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->where('siswas.nip', $guru['nip'])
            ->sum('nilais.poin');


        $laporNilai = Nilai::join('siswas', 'nilais.nis', '=', 'siswas.nis')
        ->select('nilais.nis', 'siswas.nama')
        ->selectRaw('SUM(poin) AS total_poin')
        ->where('siswas.nip', $guru['nip'])
        ->groupBy('nilais.nis', 'siswas.nama')
        ->limit(5)
        ->get();

        $lapor = [];

            foreach ($laporNilai as $item) {
                $lapor[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'total_poin' => $item->total_poin,
                ];
            }

            $hasil = Kelas::join('siswas', 'kelas.id', '=', 'siswas.id_kelas')
            ->join('nilais', 'siswas.nis', '=', 'nilais.nis')
            ->select('kelas.nama_kls')
            ->selectRaw('SUM(nilais.poin) AS total_poin')
            ->groupBy('kelas.nama_kls')
            ->orderBy('kelas.nama_kls', 'asc')
            ->limit(3)
            ->get();
        
            $leader = [];

            foreach ($hasil as $item) {
                $leader[] = [
                    'nama_kls' => $item->nama_kls,
                    'total_poin' => $item->total_poin,
                ];
            }
        

        // dd($leader);
        // $siswa = siswa::where('sisw)
        return view('Users_Page.guru.home-guru')->with(['guru' => $guru, 'count' => $count, 'nama_kelas' => $nama_kelas, 'totalPoin' => $totalPoin, 'lapor' => $lapor, 'leader' => $leader]);
    }

    public function leaderboard(request $request){
        if (!session('guru')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('menu');
        }
        $guru = session('guru');
        
        $hasil = Kelas::join('siswas', 'kelas.id', '=', 'siswas.id_kelas')
            ->join('nilais', 'siswas.nis', '=', 'nilais.nis')
            ->select('kelas.nama_kls')
            ->selectRaw('SUM(nilais.poin) AS total_poin')
            ->groupBy('kelas.nama_kls')
            ->orderBy('kelas.nama_kls', 'asc')
            ->limit(6)
            ->get();
        
            $leader = [];

            foreach ($hasil as $item) {
                $leader[] = [
                    'nama_kls' => $item->nama_kls,
                    'total_poin' => $item->total_poin,
                ];
            }
        

        return view('Users_Page.guru.leaderboard-guru')->with(['guru' => $guru, 'leader' => $leader]);
    }
    public function jadwal(request $request){
        if (!session('guru')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('menu');
        }
        $guru = session('guru');
        // Hari Senin
        $hasil1 = Siswa::join('gurus', 'siswas.nip', '=','gurus.nip')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
            ->where('siswas.nip', '=', $guru['nip'])
            ->where('jadwals.hari', '=', '1')
            ->select('siswas.nis', 'siswas.nip', 'siswas.nama as nama')
            ->get();
        
            $dataArray1 = [];

            foreach ($hasil1 as $item) {
                $dataArray1[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'nip' => $item->nip,
                ];
            }
            
        // Hari Selasa
        $hasil2 = Siswa::join('gurus', 'siswas.nip', '=','gurus.nip')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
            ->where('siswas.nip', '=', $guru['nip'])
            ->where('jadwals.hari', '=', '2')
            ->select('siswas.nis', 'siswas.nip', 'siswas.nama as nama')
            ->get();
        
            $dataArray2 = [];

            foreach ($hasil2 as $item) {
                $dataArray2[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'nip' => $item->nip,
                ];
            }
        
        // Hari Rabu
        $hasil3 = Siswa::join('gurus', 'siswas.nip', '=','gurus.nip')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
            ->where('siswas.nip', '=', $guru['nip'])
            ->where('jadwals.hari', '=', '3')
            ->select('siswas.nis', 'siswas.nip', 'siswas.nama as nama')
            ->get();
        
            $dataArray3 = [];

            foreach ($hasil3 as $item) {
                $dataArray3[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'nip' => $item->nip,
                ];
            }
        
        // Hari Kamis
        $hasil4 = Siswa::join('gurus', 'siswas.nip', '=','gurus.nip')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
            ->where('siswas.nip', '=', $guru['nip'])
            ->where('jadwals.hari', '=', '4')
            ->select('siswas.nis', 'siswas.nip', 'siswas.nama as nama')
            ->get();
        
            $dataArray4 = [];

            foreach ($hasil4 as $item) {
                $dataArray4[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'nip' => $item->nip,
                ];
            }
        
        // Hari Jumat
        $hasil5 = Siswa::join('gurus', 'siswas.nip', '=','gurus.nip')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
            ->where('siswas.nip', '=', $guru['nip'])
            ->where('jadwals.hari', '=', '5')
            ->select('siswas.nis', 'siswas.nip',  'siswas.nama as nama')
            ->get();
        
            $dataArray5 = [];

            foreach ($hasil5 as $item) {
                $dataArray5[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'nip' => $item->nip,
                ];
            }
            

                // Mendapatkan tanggal dan waktu saat ini dari server
                $currentDateTime = now()->timezone('Asia/Jakarta');
                // dd($currentDateTime);
                // Mendapatkan hari dalam format numerik (1 untuk Senin, 2 untuk Selasa, dst.)
                $currentDayOfWeek = date('N', strtotime($currentDateTime));
                
                // Jika hari ini adalah Senin (kode 1) dan tombol belum pernah diklik pada hari Senin
                //Hari senin
                if ($currentDayOfWeek == 1) {
                    // Aktifkan tombol
                    $buttonStatus1 = 'enabled';
                } else {
                    // Nonaktifkan tombol
                    $buttonStatus1 = 'disabled';
                }

                //Hari Selasa
                if ($currentDayOfWeek == 2) {
                    // Aktifkan tombol
                    $buttonStatus2 = 'enabled';
                } else {
                    // Nonaktifkan tombol
                    $buttonStatus2 = 'disabled';
                }

                //Hari Rabu
                if ($currentDayOfWeek == 3) {
                    // Aktifkan tombol
                    $buttonStatus3 = 'enabled';
                } else {
                    // Nonaktifkan tombol
                    $buttonStatus3 = 'disabled';
                }

                //Hari Kamis
                if ($currentDayOfWeek == 4) {
                    // Aktifkan tombol
                    $buttonStatus4 = 'enabled';
                } else {
                    // Nonaktifkan tombol
                    $buttonStatus4 = 'disabled';
                }

                if ($currentDayOfWeek == 5) {
                    // Aktifkan tombol
                    $buttonStatus5 = 'enabled';
                } else {
                    // Nonaktifkan tombol
                    $buttonStatus5 = 'disabled';
                }

                //Cek Hanya Sekali Klik dengan Query 
            $today = Carbon::now()->toDateString();
            $nip = $guru['nip'];
                // dd($nip);
            $btncek = Nilai::whereDate('tanggal', $today)
            ->where('nip', $nip)
            ->select('tanggal', 'nis', 'nip')
            ->get();   
            
            

            if($btncek->isEmpty()){
                $btnday = 'enabled' ;
            }else{
                $btnday = 'disabled' ;
            }

            // if ( $buttonStatus1 && $btnday ){

            // } 
            // dd($btnday);
            // dd($buttonStatus1);


            // Kirim Pesan

        return view('Users_Page.guru.jadwal-guru')->with(['guru' => $guru, 'data1' => $dataArray1, 'data2' => $dataArray2, 'data3' => $dataArray3, 'data4' => $dataArray4, 'data5' => $dataArray5, 'buttonStatus1' => $buttonStatus1, 'buttonStatus2' => $buttonStatus2, 'buttonStatus3' => $buttonStatus3, 'buttonStatus4' => $buttonStatus4, 'buttonStatus5' => $buttonStatus5, 'btnday' => $btnday]);
    } 

    public function cekJadwal(request $request){
        // Mendapatkan data dari request
            $nip = $request->nip;
            $nis = $request->nis;
            $nilai = $request->nilai;
            

            // Lakukan pengolahan dan simpan ke dalam database
    foreach ($nip as $key => $nipItem) {
        // Simpan nilai ke dalam database
        $data = [
            'nip' => $nipItem,
            'tanggal'=>now(),
            'nis' => $nis[$key], // Ambil nis berdasarkan $key
            'poin' => $nilai[$key] // Ambil nilai berdasarkan $key
        ];
        // dd($data);
        // Simpan data ke dalam tabel Nilai menggunakan model Nilai
        
        nilai::create($data);
    }
        return redirect()->route('jadwal');
    }

    public function kegiatan(request $request){
        if (!session('guru')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('menu');
        }
        $guru = session('guru');
        $kegiatans = kegiatan::select('nama_keg', 'deskripsi', 'tanggal', 'image')
                    ->where('status', 'aktif')
                    ->get();

                    $data= [];

            foreach ( $kegiatans as $item) {
                $data[] = [
                    'nama_keg' => $item->nama_keg,
                    'deskripsi' => $item->deskripsi,
                    'tanggal' => $item->tanggal,
                    'image' => $item->image,
                ];
            }
        return view('Users_Page.guru.event-guru')->with(['guru' => $guru, 'data' => $data]);
    }
    public function laporan(request $request){
        if (!session('guru')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('menu');
        }
        $guru = session('guru');
        $hasil = Nilai::join('siswas', 'nilais.nis', '=', 'siswas.nis')
            ->select('nilais.nis', 'siswas.nama')
            ->selectRaw('SUM(poin) AS total_poin')
            ->where('siswas.nip', $guru['nip'])
            ->groupBy('nilais.nis', 'siswas.nama')
            ->get();
            
            $data= [];
            foreach ( $hasil as $item) {
                $data[] = [
                    'nis' => $item->nis,
                    'nama' => $item->nama,
                    'total_poin' => $item->total_poin,
                ];
            }
          
        return view('Users_Page.guru.laporan-guru')->with(['guru' => $guru, 'data' => $data]);
    }

    public function logout()
    {
        session()->forget('guru');
        return redirect()->route('menu')->with('success', 'Logout berhasil');
    }
}
