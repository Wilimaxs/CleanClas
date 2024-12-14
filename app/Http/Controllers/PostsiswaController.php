<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeSiswa;
use App\Models\guru;
use App\Models\kelas;
use App\Models\siswa;
use Illuminate\Http\Request;

class PostsiswaController extends Controller
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
        $kls = kelas::all();
        $guru = guru::all();
        $siswa = siswa::all();
        $guruNames = guru::join('siswas', 'siswas.nip', '=', 'gurus.nip')
                      ->select('gurus.nama as nama_guru', 'siswas.nip')
                      ->get();

        $kelasNames = kelas::join('siswas', 'siswas.id_kelas', '=', 'kelas.id' )
                        ->select('kelas.nama_kls as kelas', 'siswas.id_kelas')
                        ->get();

        $siswaWithGuruNames = [];
            foreach ($siswa as $s) {
                foreach ($guruNames as $g) {
                    if ($s->nip == $g->nip) {
                        $s->nama_guru = $g->nama_guru;
                            break;
                    }
                }
                foreach ($kelasNames as $k){
                    if ($s->id_kelas == $k->id_kelas){
                        $s->kelas = $k->kelas;
                        break;
                    }
                }
                          $siswaWithGuruNames[] = $s;
            }

        // return view('posts.siswa')->with(compact('kls', 'guru', 'siswaWithGuruNames'));
        return view('posts.siswa')->with(['kls' => $kls, 'guru' => $guru, 'siswaWithGuruNames' => $siswaWithGuruNames, 'admin' => $admin]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeSiswa $request)
    {
        $admin = session('admin');
        //validasi
        $validated = $request->validated();

        $Post = new siswa();
        $Post->nis = $validated['nis'];
        $Post->nama = $validated['nama'];
        $Post->nip = $request->input('nip');
        $Post->id_kelas = $request->input('id_kelas');
        $Post->pass = $validated['pass'];
        $Post->tlp = $validated['tlp'];
        $Post->save();
        
        return redirect()->route('Psiswa.create');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nis)
    {
        // $kls = kelas::all();
        // $guru = guru::all();
        // $siswa = siswa::all();
        // $siswa = siswa::firstWhere('NIS', $nis);
        // return view('posts.siswa')->with(compact('kls', 'guru', 'siswa'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nis)
    {
        if (!session('admin')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect('/login');
        }
        $post = siswa::where('nis', $nis)->firstOrFail();
        $guru = guru::all();
        $kls = kelas::all();
        $admin = session('admin');
        if (!$post) {
            return redirect()->route('Psiswa.create')->with('error', 'Post not found');
        }

        // return view('posts.Update.siswa', compact('post', 'guru', 'kls'));
        return view('posts.Update.siswa')->with(['post' => $post, 'guru' => $guru, 'kls' => $kls, 'admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeSiswa $request, string $nis)
    {
        $Post = siswa::where('nis', $nis)->firstOrFail();
        
        $validated = $request->validated();
        if (!$Post) {
            return redirect()->route('Psiswa.create')->with('error', 'Post not found');
        }

        $Post->update([
            $Post->nama = $validated['nama'],
            $Post->nip = $request->input('nip'),
            $Post->id_kelas = $request->input('id_kelas'),
            $Post->pass = $validated['pass'],
            $Post->tlp = $validated['tlp'],
        
        ]);
        $Post->save();

        return redirect()->route('Psiswa.create')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nis)
    {
        $delete = siswa::where('nis', $nis)->firstOrFail();
        // dd($delete);
        $delete->delete();

        return redirect()->route('Psiswa.create');
    }
}
