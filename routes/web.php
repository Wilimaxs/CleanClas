<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostsiswaController;
use App\Http\Controllers\PostjadwalController;
use App\Http\Controllers\PostuserController;
use App\Http\Controllers\PostkegiatanController;
use App\Http\Controllers\PostadminController;
use App\Http\Controllers\PostcoreController;
use illuminate\Support\Facades\Auth;
use illuminate\http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//regular route and name 
// Route::get('/', function () {
//     return view('home.index', []);
// })->name('home.index');

//for inheritance 
//used controller function 
Route::get('/contact', [HomeController::class, 'contact']);

//Simple route 
//Static methode 
//No parameter route
//used controller function 
// Route::get('/', [HomeController::class, 'home'])
// ->name('simple home.example');

Route::get('/', function(){
    return view('Users_Page.home');
});

Route::get('/login-guru', function(){
    return view('Users_Page.login-guru');
});

Route::get('/login-siswa', function(){
    return view('Users_Page.login-siswa');
});

//Route Guru
// Route::get('/home-guru', function(){
//     return view('Users_Page.guru.home-guru');
// });

//Ini Controller User Sebagai guru
Route::get('guru', [PostuserController::class, 'menu'])->name('menu');//menu home
Route::post('guru/cek', [PostuserController::class, 'loginguru'])->name('login-guru');//cek login
Route::get('guru/home', [PostuserController::class, 'home'])->name('home');//login berhasil 
Route::get('guru/leaderboard', [PostuserController::class, 'leaderboard'])->name('leaderboard');//login berhasil 
Route::get('guru/jadwal', [PostuserController::class, 'jadwal'])->name('jadwal');//login berhasil 
Route::post('guru/jadwal/cek', [PostuserController::class, 'cekJadwal'])->name('jadwal-cek');//cek jadwal
Route::get('guru/kegiatan', [PostuserController::class, 'kegiatan'])->name('kegiatan');//login berhasil 
Route::get('guru/laporan', [PostuserController::class, 'laporan'])->name('laporan');//login berhasil 
Route::post('/logout/guru', [PostuserController::class, 'logout'])->name('logout-guru');//ini logout guru

//Ini Controller User Sebagai Siswa
Route::get('siswa', [PostcoreController::class, 'first'])->name('first');//Awal Login
Route::post('siswa/cek', [PostcoreController::class,'loginsiswa'])->name('login-siswa');//cek login siswa
Route::get('siswa/home',[PostcoreController::class, 'homeSiswa'])->name('home-siswa');//Login Berhasil
Route::get('siswa/leaderboard', [PostcoreController::class, 'leadsis'])->name('lead-sis');//leaderboard siswa
Route::get('siswa/jadwal',[PostcoreController::class, 'jadwalSiswa'])->name('jadwal-siswa');//jadwal
Route::get('siswa/kegiatan',[PostcoreController::class, 'kegsiswa'])->name('keg-siswa');//kegiatan
Route::get('siswa/laporan',[PostcoreController::class, 'laporSiswa'])->name('laporan-siswa');//Laporan
Route::get('/logout/siswa', [PostcoreController::class, 'logoutSiswa'])->name('logout-siswa');//ini logout siswa
//dummy data store to posts
$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],
    3 => [
        'title' => 'Intro to Golang',
        'content' => 'This is a short intro to Golang',
        'is_new' => false
    ]
];


//posts controller resource CRUD guru
Route::resource('posts', PostsController::class)
->only(['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']);
//logout posisi scntroller guru
Route::post('/logout', [PostsController::class, 'logout'])->name('logout');

//post controller resource CRUD siswa
Route::resource('Psiswa', PostsiswaController::class)
->only(['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']);

//post controller resource CRUD jadwal
Route::resource('Pjadwal', PostjadwalController::class)
->only(['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']);

//post controller resource CRUD Kegiatan
Route::resource('Pkegiatan', PostkegiatanController::class)
->only(['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']);

//post controller resource CRUD admin
Route::resource('Padmin', PostadminController::class)
->only(['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']);

// authenthication 
// Auth::routes();


//authentication Admin
Route::get('login', [PostadminController::class, 'login'])->name('login');
Route::post('login/cek', [PostadminController::class, 'loginPost'])->name('login');



// //request/reading input from user 
// Route::get('/post', function() use($posts){
//     //dd use for dumb data 
//     // dd(request()->all());
//     dd((int)request()->input('page', 2));
//     return view('posts.index', ['posts' => $posts]);
// });


// //passing data form dummy data 
// //use() from posts
// Route::get('/post/{id}', function($id) use($posts){

//     //generate error 
//     //direct error to 404-page not found
//     abort_if(!isset($posts[$id]), 404);

//     return view('posts.show', ['post' => $posts[$id]]);
// })->name('posts.show');


//parameter route/parameter from link URL
Route::get('/siswa/{id}', function($nip){
    return 'Menu Ortu ' . $nip;
});


//optional parameter 
Route::get('/guru/kode/{id?}', function($id = 20){
    return 'Kode Siswa '. $id .' id'; 
});








//GROUP ROUTE
Route::prefix('/fun')->name('fun.')->group(function() use($posts){
    //reponse code with dummy route
Route::get('response', function() use($posts){
    return response($posts , 201)
    ->header('content-type', 'application/json')
    ->cookie('MY_COOKIE', 'Wildan', 3600);
})->name('response');

//redirect response
Route::get('redirect', function(){
    return redirect('/contact');
})->name('redirect');

//redirect to last address or URL
Route::get('back', function(){
    return back();
})->name('back');

//redirect to route name
Route::get('named_route', function(){
    return redirect()->route('posts.show', ['id' => 1]);
})->name('named_route');

Route::get('named_route', function(){
    return redirect()->route('Psiswa.show', ['id' => 1]);
})->name('named_route1');

//redirect to another page, this example is google.com
Route::get('away', function(){
    return redirect()->away('https://google.com');
})->name('away');

//chage data become json format
Route::get('json', function() use($posts) {
    return response()->json($posts);
})->name('json');

//download 
Route::get('download', function() use($posts) {
    return response()->download(public_path('daniel.jpg'), 'face.jpg');
})->name('download'); 
});

