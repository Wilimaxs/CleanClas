<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAdmin;
use App\Models\admin;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostadminController extends Controller
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
        $admin12 = admin::all();
        // return view('posts.admin')->with(compact('admin'));
        return view('posts.admin')->with(['admin' => $admin, 'admin12' => $admin12]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeAdmin $request)
    {

        $validated = $request->validated();


        $Post = new admin();
        $Post->nip = $validated['nip'];
        $Post->nama = $validated['nama'];
        $Post->tlp = $validated['tlp'];
        $Post->alamat = $validated['alamat'];
        $Post->pass = $validated['pass'];
        $Post->save();

        return redirect()->route('Padmin.create');
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
    public function edit(string $nip)
    {
        if (!session('admin')) {
            // Jika tidak ada data admin dalam session, arahkan pengguna ke halaman login
            return redirect('/login');
        }
        $admin = session('admin');
        $post = admin::where('nip', $nip)->firstOrFail();

        if (!$post) {
            return redirect()->route('Padmin.create')->with('error', 'Post not found');
        }

        // return view('posts.Update.admin', compact('post'));
        return view('posts.Update.admin')->with(['post' => $post, 'admin' => $admin] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeAdmin $request, string $nip)
    {
        $Post = admin::where('nip', $nip)->firstOrFail();
        
        $validated = $request->validated();
        if (!$Post) {
            return redirect()->route('Padmin.create')->with('error', 'Post not found');
        }

        $Post->update([
            'nama' => $validated['nama'],
            'tlp' => $validated['tlp'],
            'alamat' => $validated['alamat'],
            'pass' => $validated['pass'],
        ]);
        $Post->save();

        return redirect()->route('Padmin.create')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        $delete = admin::where('nip', $nip)->firstOrFail();
        // dd($delete);
        $delete->delete();

        return redirect()->route('Padmin.create');
    }

    public function login()
    {
            return view('home.login');
    }

    public function loginPost(request $request)
    {

        $credential = [
            'nip' => $request->nip,
            'password' => $request->pass,
        ];

        // Log::info('Credentials:', $credential);

        // if(Auth::attempt($credential)){
        //     Log::info('Login attempt successful');
        //     return redirect('/posts/create')->with('sukses', 'Login Berhasil');
        // }
        // Log::warning('Login attempt failed:', $credential);
        // return back()->with('error', 'Nip atau Passwrod tidak sesuai');
 
        $admin = Admin::where('nip', $credential['nip'])->first();
        if ($admin && $admin->password == $credential['password']) {
            // Login berhasil
            // Log::info('Login attempt successful');
            // dd($admin);
            session(['admin' => $admin]); // Simpan data admin ke dalam sesi
            // return redirect('/posts/create')->with('admin', $admin);
            return redirect('/posts/create');
        } else {
            // Login gagal
            Log::warning('Login attempt failed');
            return back()->with('error', 'NIP atau Password tidak sesuai');
        }
    }
    
}
