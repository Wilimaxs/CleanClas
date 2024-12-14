<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeKegiatan;
use App\Models\hari;
use App\Models\kegiatan;
use Illuminate\Http\Request;

class PostkegiatanController extends Controller
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
        $kegiatan = kegiatan::all();
        $hari = hari::all();
        $namaHari = hari::join('kegiatans', 'haris.id', '=', 'kegiatans.hari')
                        ->select('haris.nama_hari as nama_hari', 'kegiatans.hari')
                        ->get();
        
        $storeData = [];
        foreach($kegiatan as $k){
            foreach($namaHari as $n){
                if ($k->hari == $n->hari){  
                    $k->nama_hari = $n->nama_hari;
                    break;
                }
            }
            $storeData[] = $k;
        }


        // return view('posts.kegiatan')->with(compact('kegiatan', 'hari', 'storeData'));
        return view('posts.kegiatan')->with(['kegiatan' => $kegiatan, 'hari' => $hari, 'storeData' => $storeData, 'admin' => $admin]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeKegiatan $request)
    {
        // validasi request
        $validated = $request->validated();

        $path = '';
        $filename = '';
        // Upload file ke storage local
        if($request->hasFile('image')){
            $file = $validated['image'];
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/image/';
            $file->move($path, $filename);
        }
        
        // Simpan informasi file ke database
        $post = new kegiatan();
        $post->id_keg = $validated['id_keg'];
        $post->nama_keg = $validated['nama_keg'];
        $post->deskripsi = $validated['deskripsi'];
        $post->tanggal = $validated['tanggal'];
        $post->status = $request->input('status');
        $post->hari = $request->input('hari');
        $post->image = $path.$filename;

        $post->save();
        return redirect()->route('Pkegiatan.create');
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
    public function edit(string $id_keg)
    {
        if (!session('admin')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect('/login');
        }
        $admin = session('admin');
        $post = kegiatan::where('id_keg', $id_keg)->firstOrFail();
        $hari = hari::all();

        if (!$post) {
            return redirect()->route('Pjadwal.create')->with('error', 'Post not found');
        }

        // return view('posts.Update.kegiatan', compact('post', 'hari'));
        return view('posts.Update.kegiatan')->with(['post' => $post, 'hari' => $hari, 'admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeKegiatan $request, string $id_keg)
    {
        $Post = kegiatan::where('id_keg', $id_keg)->firstOrFail();
        
        $validated = $request->validated();
        if (!$Post) {
            return redirect()->route('Pkegiatan.create')->with('error', 'Post not found');
        }
        // dd($Post);

        $path = '';
        $filename = '';
        // Upload file ke storage local
        if($request->hasFile('image')){
            $file = $validated['image'];
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/image/';
            $file->move($path, $filename);
        }

        $Post->update([
            'nama_keg' => $validated['nama_keg'], 
            'deskripsi' => $validated['deskripsi'], 
            'tanggal' => $validated['tanggal'], 
            'status' => $request->input()['status'], 
            'hari' => $request->input()['hari'], 
            'image' => $path.$filename
        ]);
        $Post->save();

        return redirect()->route('Pkegiatan.create')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_keg)
    {
        $delete = kegiatan::where('id_keg', $id_keg)->firstOrFail();
        // dd($delete);
        $delete->delete();

        return redirect()->route('Pkegiatan.create');
    }
}
