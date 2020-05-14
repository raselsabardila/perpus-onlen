<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Book;
use App\User;
use App\Peminjaman;

class UserController extends Controller
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
        $user2=User::paginate(12);
        $book=Book::all();
        $user=User::where("id",Auth::id())->first();   
        $peminjaman=Peminjaman::all();
        return view("admin.user.index",compact('user',"book","peminjaman","user2"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user2=User::find($id);
        if(Auth::id() != $user2->id){
            return redirect()->route(("home"));
        }
        $user=User::where("id",Auth::id())->first();   
        return view("admin.user.edit",compact("user","user2"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        if($request->password == null && $request->foto == null){
            $user=User::find($id)->update([
                "name"=>$request->name,
            ]);

            return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil Di Update");
        }elseif($request->foto == null){
            $user=User::find($id)->update([
                "name"=>$request->name,
                "password"=>bcrypt($request->password)
            ]);
            return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil Di Update");
        }elseif($request->password == null){
            $file=$request->file("foto");
            $nama_file=$file->getClientOriginalName();
            $destination="upload_file";
            $nama_split=explode(".",$nama_file);
            $nama_split[0]=uniqid();
            $namefoto="";
            $namefoto .= $nama_split[0];
            $namefoto .= ".";
            $namefoto .= $nama_split[1];

            $file->move($destination,$namefoto);

                $user=User::find($id)->update([
                    "name"=>$request->name,
                    "foto"=>$namefoto
                ]);
                return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil Di Update");
        }else{
            $file=$request->file("foto");
            $nama_file=$file->getClientOriginalName();
            $destination="upload_file";
            $nama_split=explode(".",$nama_file);
            $nama_split[0]=uniqid();
            $namefoto="";
            $namefoto .= $nama_split[0];
            $namefoto .= ".";
            $namefoto .= $nama_split[1];
    
    
            $file->move($destination,$namefoto);
    
            $user=User::find($id)->update([
                "name"=>$request->name,
                "foto"=>$namefoto,
                "password"=>bcrypt($request->password)
            ]);
            return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil Di Update");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
