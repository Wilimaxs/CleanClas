<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeJadwal;
use App\Models\guru;
use App\Models\hari;
use App\Models\jadwal;
use App\Models\siswa;
use Illuminate\Http\Request;
use Monolog\Handler\FormattableHandlerInterface;

use function Laravel\Prompts\select;

class PostjadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session('admin')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect('/login');
        } 
        $admin = session('admin');
        $siswa = siswa::all();
        $guru = guru::all();
        $jadwal = jadwal::all();
        $hari = hari::all();
        

        $jadwalWithKet = Jadwal::join('siswas', 'jadwals.nis', '=', 'siswas.nis')
                                ->join('gurus', 'siswas.nip', '=', 'gurus.nip')
                                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                                ->join('haris', 'jadwals.hari', '=', 'haris.id')
                                ->select('siswas.nama as nama_siswa', 'gurus.nama as nama_guru', 'kelas.nama_kls as nama_kelas', 'haris.nama_hari as hari', 'jadwals.id_jadwal')
                                ->get();

        // return view('posts.jadwal')->with(compact('siswa', 'guru','hari', 'jadwalWithKet'));
        return view('posts.jadwal')->with(['siswa' => $siswa, 'guru' => $guru, 'hari' => $hari, 'jadwalWithKet' => $jadwalWithKet, 'admin' => $admin]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeJadwal $request)
    {
        $admin = session('admin');

        //validation 
        $validated = $request->validated();

        $Post = new jadwal();
        $Post->id_jadwal = $validated['id'];
        $Post->nis = $request->input('nis');
        $Post->hari = $request->input('hari');
        $Post->save();
        
        return redirect()->route('Pjadwal.create')->with(['admin' => $admin]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_jadwal)
    {
        if (!session('admin')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect('/login');
        }
        $post = jadwal::where('id_jadwal', $id_jadwal)->firstOrFail();
        $siswa = siswa::all();
        $hari = hari::all();
        $nisFromPost = $post->nis;
        $nama = $siswa->firstWhere('nis', $nisFromPost);
        $admin = session('admin');

        if (!$post) {
            return redirect()->route('Pjadwal.create')->with('error', 'Post not found');
        }

        return view('posts.Update.jadwal')->with(['post' => $post, 'hari' => $hari, 'nama' => $nama, 'admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeJadwal $request, string $id_jadwal)
    {
        $Post = jadwal::where('id_jadwal', $id_jadwal)->firstOrFail();
        
        $validated = $request->validated();
        if (!$Post) {
            return redirect()->route('Pjadwal.create')->with('error', 'Post not found');
        }
        // dd($Post);

        $Post->update([
            'hari' => $request->input()['hari'], 
        ]);
        $Post->save();

        return redirect()->route('Pjadwal.create')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jadwal)
    {
        $delete = jadwal::where('id_jadwal', $id_jadwal)->firstOrFail();
        // dd($delete);
        $delete->delete();

        return redirect()->route('Pjadwal.create');
    }
}
