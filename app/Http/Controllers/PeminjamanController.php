<?php

namespace App\Http\Controllers;

use App\Peminjaman;
use App\Book;
use Auth;
use App\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::where("id",Auth::id())->first();
        $book=Peminjaman::where("peminjam",Auth::id())->latest()->paginate(12);
        return view("admin.peminjaman.index",compact("book","user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        
    }

    public function pinjam($id){
        $cek=Book::where("id",$id)->where("status",0)->first();
        if ($cek) {
            return redirect()->route("home")->with("status","Buku Tidak Dapat Dipinjam");
        }

        Peminjaman::create([
            "buku_id"=>$id,
            "peminjam"=>Auth::id()
        ]);

        $book=Book::where("id",$id)->update([
            "status_peminjaman"=>1
        ]);

        return redirect()->route("home")->with("status","Buku Menunggu Persetujuan Admin");
    }

    public function kembalikan($id){
        Book::where("id",$id)->update([
            "status_peminjaman"=>0
        ]);

        Peminjaman::where("buku_id",$id)->where("status_peminjaman",1)->update(["status_peminjaman"=>3]);

        return redirect()->route("home")->with("status","Buku Berhasil Di Kembalikan!!");
    }

    public function setujui($id){
        Peminjaman::where("id",$id)->update([
            "status_peminjaman"=>1
        ]);

        return redirect()->route("book.dipinjam")->with("status","Buku Berhasil Di ACC");
    }

    public function tolak($id){
        Peminjaman::where("id",$id)->update([
            "status_peminjaman"=>2
        ]);

        $buku=Peminjaman::where("id",$id)->first();
        Book::where("id",$buku->buku_id)->update([
            "status_peminjaman"=>0
        ]);

        return redirect()->route("book.dipinjam")->with("status","Buku Berhasil Di Tolak");
    }

    public function clear($id){
        if($id != Auth::id()){
            return redirect()->route("peminjaman.index")->with("status","Tidak Dapat Menghapus History");
        }
        $data=Peminjaman::where("peminjam",$id)->get();
        foreach ($data as $key) {
            $key->delete();
        }
        return redirect()->route("peminjaman.index")->with("status","History Berhasil Di Hapus");
    }
}
