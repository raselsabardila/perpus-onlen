<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect()->route("home");
});

Route::group(["middleware"=>"auth"],function(){
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

    Route::post('/category/search',"CategoryController@search")->name("category.search");
    Route::resource("/category","CategoryController");

    Route::get("/book/dipinjam","BookController@dipinjam")->name("book.dipinjam");
    Route::get("/book/noactive","BookController@nonaktive")->name("book.nonaktive");
    Route::get("/book/status/{id}","BookController@status")->name("book.status");
    Route::post("/book/search","BookController@search")->name("book.search");
    Route::resource("/book","BookController");

    Route::get("/peminjaman/clear/{id}","PeminjamanController@clear")->name("peminjaman.clear");
    Route::get("/peminjaman/tolak/{id}","PeminjamanController@tolak")->name("peminjaman.tolak");
    Route::get("/peminjaman/setujui/{id}","PeminjamanController@setujui")->name("peminjaman.setujui");
    Route::get("/peminjaman/kembalikan/{id}","PeminjamanController@kembalikan")->name("peminjaman.kembalikan");
    Route::get("/peminjaman/pinjam/{id}","PeminjamanController@pinjam")->name("peminjaman.pinjam");
    Route::resource("/peminjaman","PeminjamanController");

    Route::get("/laporan","laporan@index")->name("laporan.index");

    Route::resource("/user","UserController");
});

