<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use Auth;
use App\Peminjaman;
use App\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->permission == 0) {
            return redirect("home");
        }
        $user=User::where("id",Auth::id())->first();
        $book=Book::latest()->paginate(10);

        return view("admin.buku.index",compact("book","user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->permission == 0) {
            return redirect("home");
        }
        $user=User::where("id",Auth::id())->first();
        $category=Category::all();

        return view("admin.buku.create",compact("category","user"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "judul"=>"required|min:3",
            "kategori"=>"required",
            "keterangan"=>"required|min:10",
            "sampul"=>"required|mimes:png,jpg,jpeg,svg,gif",
            "ebook"=>"required|mimes:pdf"
        ]);

        $file_sampul=$request->file("sampul");
        $nama_sampul=$file_sampul->getClientOriginalName();
        $destination="upload_file";
        $nama_sampul_split=explode(".",$nama_sampul);
        $nama_sampul_split[0]=uniqid();
        $namasampulasli="";
        $namasampulasli .= $nama_sampul_split[0];
        $namasampulasli .= ".";
        $namasampulasli .= $nama_sampul_split[1];
        $file_sampul->move($destination,$namasampulasli);

        $file_ebook=$request->file("ebook");
        $nama_ebook=$file_ebook->getClientOriginalName();
        $destinationn="upload_file";
        $nama_ebook_split=explode(".",$nama_ebook);
        $nama_ebook_split[0]=uniqid();
        $namaebookasli="";
        $namaebookasli .= $nama_ebook_split[0];
        $namaebookasli .= ".";
        $namaebookasli .= $nama_ebook_split[1];
        $file_ebook->move($destinationn,$namaebookasli);

        Book::create([
            "judul"=>$request->judul,
            'kategori_id'=>$request->kategori,
            "keterangan"=>$request->keterangan,
            "sampul"=>$namasampulasli,
            "ebook"=>$namaebookasli,
            "user_id"=>Auth::id(),
        ]);

        return redirect()->route("book.index")->with("status","Data Berhasil Di Tambahkan!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        if (Auth::user()->permission == 0) {
            return redirect("home");
        }
        $user=User::where("id",Auth::id())->first();
        $category=Category::all();
        $buku=$book;

        return view("admin.buku.edit",compact("category","buku","user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            "judul"=>"required|min:3",
            "kategori"=>"required",
            "keterangan"=>"required|min:10"
        ]);

        if ($request->sampul == null && $request->ebook == null) {
            $book->update([
                "judul"=>$request->judul,
                "keterangan"=>$request->keterangan,
                "kategori_id"=>$request->kategori,
                "user_id"=>Auth::id()
            ]);

            return redirect()->route("book.index")->with('status',"Data Berhasil Di Edit!!");
        }elseif ($request->sampul==null) {
            $file_ebook=$request->file("ebook");
            $nama_ebook=$file_ebook->getClientOriginalName();
            $destinationn="upload_file";
            $nama_ebook_split=explode(".",$nama_ebook);
            $nama_ebook_split[0]=uniqid();
            $namaebookasli="";
            $namaebookasli .= $nama_ebook_split[0];
            $namaebookasli .= ".";
            $namaebookasli .= $nama_ebook_split[1];
            $file_ebook->move($destinationn,$namaebookasli);

            $book->update([
                "judul"=>$request->judul,
                "keterangan"=>$request->keterangan,
                "kategori_id"=>$request->kategori,
                "ebook"=>$namaebookasli,
                "user_id"=>Auth::id()
            ]);

            return redirect()->route("book.index")->with('status',"Data Berhasil Di Edit!!");
        }elseif($request->ebook == null){
            $file_sampul=$request->file("sampul");
            $nama_sampul=$file_sampul->getClientOriginalName();
            $destination="upload_file";
            $nama_sampul_split=explode(".",$nama_sampul);
            $nama_sampul_split[0]=uniqid();
            $namasampulasli="";
            $namasampulasli .= $nama_sampul_split[0];
            $namasampulasli .= ".";
            $namasampulasli .= $nama_sampul_split[1];
            $file_sampul->move($destination,$namasampulasli);

            $book->update([
                "judul"=>$request->judul,
                "keterangan"=>$request->keterangan,
                "kategori_id"=>$request->kategori,
                "sampul"=>$namasampulasli,
                "user_id"=>Auth::id()
            ]);

            return redirect()->route("book.index")->with('status',"Data Berhasil Di Edit!!");
        }else{
            $file_sampul=$request->file("sampul");
            $nama_sampul=$file_sampul->getClientOriginalName();
            $destination="upload_file";
            $nama_sampul_split=explode(".",$nama_sampul);
            $nama_sampul_split[0]=uniqid();
            $namasampulasli="";
            $namasampulasli .= $nama_sampul_split[0];
            $namasampulasli .= ".";
            $namasampulasli .= $nama_sampul_split[1];
            $file_sampul->move($destination,$namasampulasli);
    
            $file_ebook=$request->file("ebook");
            $nama_ebook=$file_ebook->getClientOriginalName();
            $destinationn="upload_file";
            $nama_ebook_split=explode(".",$nama_ebook);
            $nama_ebook_split[0]=uniqid();
            $namaebookasli="";
            $namaebookasli .= $nama_ebook_split[0];
            $namaebookasli .= ".";
            $namaebookasli .= $nama_ebook_split[1];
            $file_ebook->move($destinationn,$namaebookasli);
    
            $book->update([
                "judul"=>$request->judul,
                "keterangan"=>$request->keterangan,
                "kategori_id"=>$request->kategori,
                "user_id"=>Auth::id(),
                "ebook"=>$namaebookasli,
                "sampul"=>$namasampulasli
            ]);
    
            return redirect()->route("book.index")->with('status',"Data Berhasil Di Edit!!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route("book.index")->with("status","Data Berhasil Di Hapus");
    }

    public function search(Request $request){
        $book=Book::where("judul",$request->search)->orWhere("judul","like","%".$request->search."%")->paginate(10);

        return view("admin.buku.index",compact("book"));
    }

    public function status($id){
        $buku=Book::find($id);
        
        if ($buku->status == 1) {
            $buku->update([
                "status"=>0
            ]);

            return redirect()->route("book.index")->with("status","Status Buku Telah di Non-Aktifkan");
        } else {
            $buku->update([
                "status"=>1
            ]);

            return redirect()->route("book.index")->with("status","Status Buku Telah di Aktifkan");
        }
    }

    public function stok(){
        $book=Book::where("stok",0)->latest()->paginate(10);
        return view("admin.buku.stok",compact("book"));
    }

    public function nonaktive(){
        if (Auth::user()->permission == 0) {
            return redirect("home");
        }
        $user=User::where("id",Auth::id())->first();
        $book=Book::where("status",0)->latest()->paginate(10);
        return view("admin.buku.nonaktive",compact("book","user"));
    }

    public function dipinjam(){
        if (Auth::user()->permission == 0) {
            return redirect("home");
        }
        $book=Peminjaman::paginate(10);
        $user=User::where("id",Auth::id())->first();

        return view("admin.buku.dipinjam",compact("user","book"));
    }
}
