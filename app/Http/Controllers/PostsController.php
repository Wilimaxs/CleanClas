<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePost;
use App\Models\Admin;
use App\Models\guru;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // private $posts = [
    //     1 => [
    //         'title' => 'Intro to Laravel',
    //         'content' => 'This is a short intro to Laravel',
    //         'is_new' => true,
    //         'has_comments' => true
    //     ],
    //     2 => [
    //         'title' => 'Intro to PHP',
    //         'content' => 'This is a short intro to PHP',
    //         'is_new' => false
    //     ],
    //     3 => [
    //         'title' => 'Intro to Golang',
    //         'content' => 'This is a short intro to Golang',
    //         'is_new' => false
    //     ]
    // ];

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
        // if(session()->has('admin')) {
        //     // Ambil data admin dari sesi
            
        //     $admin = session('admin');
        //     // dd($admin);
        // } else {
        //     // Jika tidak ada data admin dalam sesi, lakukan penanganan yang sesuai
        //     // Contohnya, Anda bisa mengarahkan pengguna kembali ke halaman login
        //     return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        // }
        $admin = session('admin');
        // dd($admin);
        $guru = guru::all();
        return view('posts.guru')->with(['guru' => $guru, 'admin' => $admin]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storePost $request)
    {
        

        // $admin = Admin::where('nip', $request->input('nama_admin'))->first();
        // $admin = session('admin');
        // dd($admin);
         //validation 
        $validated = $request->validated();

        $Post = new guru();
        $Post->nip = $validated['nip'];
        $Post->nama = $validated['nama'];
        $Post->tlp = $validated['tlp'];
        $Post->pass = $validated['pass'];
        $Post->save();


        return redirect()->route('posts.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nip)
    {
    //     // abort_if(!isset($this->posts[$id]), 404);
    //     $guru = Guru::firstWhere('NIP', $nip);
    //     return view('posts.show', ['post' => $guru]);
    // //  return view('posts.show', ['post' => guru::findOr($nip)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nip)
    {
        if (!session('admin')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect('/login');
        }
        
        $post = guru::where('nip', $nip)->firstOrFail();
        $admin = session('admin');
        if (!$post) {
            return redirect()->route('posts.create')->with('error', 'Post not found');
        }

        return view('posts.Update.guru')->with(['post' => $post, 'admin' =>$admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storePost $request, string $nip)
    { 
        
        $Post = guru::where('nip', $nip)->firstOrFail();
        
        $validated = $request->validated();
        if (!$Post) {
            return redirect()->route('posts.create')->with('error', 'Post not found');
        }

        $Post->update([
            'nama' => $validated['nama'],
            'tlp' => $validated['tlp'],
            'pass' => $validated['pass'],
        ]);
        $Post->save();

        return redirect()->route('posts.create')->with('success', 'Post updated successfully');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        $delete = guru::where('nip', $nip)->firstOrFail();
        // dd($delete);
        $delete->delete();

        return redirect()->route('posts.create');
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect('/login')->with('success', 'Logout berhasil');
    }

}
