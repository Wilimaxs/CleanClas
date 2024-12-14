<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use App\Models\kelas;
use App\Models\nilai;
use App\Models\siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostcoreController extends Controller
{
    public function first(){
        if (session('siswa')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('home-siswa');
        }
        return view('Users_Page.login-siswa');
    }

    public function loginsiswa(request $request)
    {

        $credential = [
            'nis' => $request->nis,
            'password' => $request->pass,
        ];

        
        $siswa = siswa::where('nis', $credential['nis'])->first();
        // dd($siswa);
        if ($siswa && $siswa->password == $credential['password']) {
            session(['siswa' => $siswa]); // Simpan data siswa ke dalam sesi
    
            return redirect()->route('home-siswa');
        } else {
            return back()->with('error', 'NIP atau Password tidak sesuai');
        }
    }

    public function homeSiswa(){
        if (!session('siswa')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('first');
        }
        $siswa = session('siswa');
        
        $hasil = siswa::join('gurus', 'siswas.nip', '=', 'gurus.nip')
        ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        ->where('siswas.nis', '=', $siswa['nis'])
        ->select('gurus.nama as nama_guru', 'siswas.nama as nama_siswa', 'siswas.nis', 'kelas.nama_kls')
        ->get();

        // dd($hasil);

        $identitas = [];
        
        foreach ($hasil as $item) {
            $identitas[] = [
                'nama_guru' => $item->nama_guru,
                'nama_siswa' => $item->nama_siswa,
                'nis' => $item->nis,
                'nama_kls' => $item->nama_kls,
            ];
        }
    //    Ngambil Leaderboard
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

            //Tarik Data Untuk Laporan
        $hasil = nilai::join('siswas', 'nilais.nis', '=', 'siswas.nis')
        ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
        ->join('haris', 'jadwals.hari', '=', 'haris.id')
        ->where('nilais.nis', '=', $siswa['nis'])
        ->select('haris.nama_hari', 'nilais.tanggal', 'nilais.poin')
        ->get();
        
            // Set lokal bahasa Indonesia
            Carbon::setLocale('id');

        $laporan = [];

        foreach ($hasil as $item) {
            // Konversi format tanggal dari Y-m-d menjadi j-M-Y
            $tanggalBaru = Carbon::parse($item->tanggal)->translatedFormat('j F Y');
        
            $laporan[] = [
                'nama_hari' => $item->nama_hari,
                'tanggal' => $tanggalBaru, // Menggunakan format tanggal yang baru
                'poin' => $item->poin,
            ];
        }

       //Tarik Data untuk Poin Siswa
       $total = nilai::join('siswas', 'nilais.nis', '=', 'siswas.nis')
        ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
        ->join('haris', 'jadwals.hari', '=', 'haris.id')
        ->where('nilais.nis', '=', $siswa['nis'])
        ->sum('nilais.poin');


        //Tarik Data Untuk Mendapatkan Hasil Tanggal Selanjutnya Piket si Siswa
        $nis = $siswa['nis'];
        
        $data = Nilai::join('jadwals', 'nilais.nis', '=', 'jadwals.nis')
            ->join('haris', 'jadwals.hari', '=', 'haris.id')
            ->join('siswas', 'nilais.nis', '=', 'siswas.nis')
            ->where('nilais.nis', '=', $nis)
            ->where('nilais.tanggal', function ($query) use ($nis) {
                $query->selectRaw('MAX(tanggal)')
                    ->from('nilais')
                    ->where('nis', $nis);
                    
            })
            ->select('haris.nama_hari', 'nilais.tanggal')
            ->get();

        // dd($data[0]['tanggal']);

            // Konversi format tanggal dari Y-m-d menjadi j-M-Y
            
            $nama_hari = $data[0]['nama_hari'];

            $tgllanjut = Carbon::parse($data[0]['tanggal'])->addDays(7)->format('Y-m-d');

            $Tglbaru = Carbon::parse($tgllanjut)->translatedFormat('j F Y');
            
            
            // dd($nama_hari);
            
        


        return view('Users_Page.siswa.home-siswa')->with(['identitas' => $identitas, 'leader' => $leader, 'laporan' => $laporan, 'total' => $total, 'Tglbaru' => $Tglbaru, 'nama_hari' => $nama_hari]);
    }

    public function leadsis(){
        if (!session('siswa')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('first');
        }
        $siswa = session('siswa');

        $hasil = siswa::join('gurus', 'siswas.nip', '=', 'gurus.nip')
        ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        ->where('siswas.nis', '=', $siswa['nis'])
        ->select('gurus.nama as nama_guru', 'siswas.nama as nama_siswa', 'siswas.nis', 'kelas.nama_kls')
        ->get();

        // dd($hasil);

        $identitas = [];
        
        foreach ($hasil as $item) {
            $identitas[] = [
                'nama_guru' => $item->nama_guru,
                'nama_siswa' => $item->nama_siswa,
                'nis' => $item->nis,
                'nama_kls' => $item->nama_kls,
            ];
        }

        //ngambil Data LeaderBoard
        $hasil = kelas::join('siswas', 'kelas.id', '=', 'siswas.id_kelas')
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


        return view('Users_Page.siswa.leaderboard')->with(['identitas' => $identitas, 'leader' => $leader]);
    }

    public function jadwalSiswa(){
        if (!session('siswa')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('first');
        }
        $siswa = session('siswa');
        // dd($siswa);
        $hasil = siswa::join('gurus', 'siswas.nip', '=', 'gurus.nip')
        ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        ->where('siswas.nis', '=', $siswa['nis'])
        ->select('gurus.nama as nama_guru', 'siswas.nama as nama_siswa', 'siswas.nis', 'kelas.nama_kls')
        ->get();

        // dd($hasil);

        $identitas = [];
        
        foreach ($hasil as $item) {
            $identitas[] = [
                'nama_guru' => $item->nama_guru,
                'nama_siswa' => $item->nama_siswa,
                'nis' => $item->nis,
                'nama_kls' => $item->nama_kls,
            ];
        }

        //Mengambil data Jadwal
        // Hari Senin
        $hasil1 = siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'jadwals.nis', '=', 'siswas.nis')
            ->where('kelas.id', '=', $siswa['id_kelas'])
            ->where('jadwals.hari', '=', 1)
            ->select('siswas.nama')
            ->get();
        
            $senin = [];

            foreach ($hasil1 as $item) {
                $senin[] = [
                    'nama' => $item->nama,
                ];
            }

        // Hari selasa
        $hasil2 = siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'jadwals.nis', '=', 'siswas.nis')
            ->where('kelas.id', '=', $siswa['id_kelas'])
            ->where('jadwals.hari', '=', 2)
            ->select('siswas.nama')
            ->get();
        
            $selasa = [];

            foreach ($hasil2 as $item) {
                $selasa[] = [
                    'nama' => $item->nama,
                ];
            }
        // Hari rabu
        $hasil3 = siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'jadwals.nis', '=', 'siswas.nis')
            ->where('kelas.id', '=', $siswa['id_kelas'])
            ->where('jadwals.hari', '=', 3)
            ->select('siswas.nama')
            ->get();
        
            $rabu = [];

            foreach ($hasil3 as $item) {
                $rabu[] = [
                    'nama' => $item->nama,
                ];
            }
        // Hari kamis
        $hasil4 = siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'jadwals.nis', '=', 'siswas.nis')
            ->where('kelas.id', '=', $siswa['id_kelas'])
            ->where('jadwals.hari', '=', 4)
            ->select('siswas.nama')
            ->get();
        
            $kamis = [];

            foreach ($hasil4 as $item) {
                $kamis[] = [
                    'nama' => $item->nama,
                ];
            }
        // Hari jumat
        $hasil5 = siswa::join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('jadwals', 'jadwals.nis', '=', 'siswas.nis')
            ->where('kelas.id', '=', $siswa['id_kelas'])
            ->where('jadwals.hari', '=', 5)
            ->select('siswas.nama')
            ->get();
        
            $jumat = [];

            foreach ($hasil5 as $item) {
                $jumat[] = [
                    'nama' => $item->nama,
                ];
            }

            
            

        return view('Users_Page.siswa.jadwal')->with(['identitas' => $identitas, 'senin' => $senin, 'selasa' => $selasa, 'rabu' => $rabu, 'kamis' => $kamis, 'jumat' => $jumat]);
    }

    public function kegsiswa(){
        if (!session('siswa')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('first');
        }
        $siswa = session('siswa');
        // dd($siswa);
        $hasil = siswa::join('gurus', 'siswas.nip', '=', 'gurus.nip')
        ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        ->where('siswas.nis', '=', $siswa['nis'])
        ->select('gurus.nama as nama_guru', 'siswas.nama as nama_siswa', 'siswas.nis', 'kelas.nama_kls')
        ->get();

        // dd($hasil);

        $identitas = [];
        
        foreach ($hasil as $item) {
            $identitas[] = [
                'nama_guru' => $item->nama_guru,
                'nama_siswa' => $item->nama_siswa,
                'nis' => $item->nis,
                'nama_kls' => $item->nama_kls,
            ];
        }

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

        return view('Users_Page.siswa.event')->with(['identitas' => $identitas, 'data' => $data]);
    }

    public function laporSiswa(){
        if (!session('siswa')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect()->route('first');
        }
        $siswa = session('siswa');
        // dd($siswa);
        $hasil = siswa::join('gurus', 'siswas.nip', '=', 'gurus.nip')
        ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        ->where('siswas.nis', '=', $siswa['nis'])
        ->select('gurus.nama as nama_guru', 'siswas.nama as nama_siswa', 'siswas.nis', 'kelas.nama_kls')
        ->get();

        // dd($hasil);

        $identitas = [];
        
        foreach ($hasil as $item) {
            $identitas[] = [
                'nama_guru' => $item->nama_guru,
                'nama_siswa' => $item->nama_siswa,
                'nis' => $item->nis,
                'nama_kls' => $item->nama_kls,
            ];
        }

        //Tarik Data Untuk Laporan
        $hasil = nilai::join('siswas', 'nilais.nis', '=', 'siswas.nis')
        ->join('jadwals', 'siswas.nis', '=', 'jadwals.nis')
        ->join('haris', 'jadwals.hari', '=', 'haris.id')
        ->where('nilais.nis', '=', $siswa['nis'])
        ->select('haris.nama_hari', 'nilais.tanggal', 'nilais.poin')
        ->get();
        
            // Set lokal bahasa Indonesia
            Carbon::setLocale('id');

        $laporan = [];

        foreach ($hasil as $item) {
            // Konversi format tanggal dari Y-m-d menjadi j-M-Y
            $tanggalBaru = Carbon::parse($item->tanggal)->translatedFormat('j F Y');
        
            $laporan[] = [
                'nama_hari' => $item->nama_hari,
                'tanggal' => $tanggalBaru, // Menggunakan format tanggal yang baru
                'poin' => $item->poin,
            ];
        }
            // dd($laporan);

        return view('Users_Page.siswa.laporan')->with(['identitas' => $identitas, 'laporan' => $laporan]);
    }

    public function logoutSiswa(){
        session()->forget('siswa');
        return redirect()->route('first')->with('success', 'Logout berhasil');
    }
}
