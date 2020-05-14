<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use App\User;

class CategoryController extends Controller
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
        $category=Category::latest()->paginate(10);
        return view("admin.category.index",compact("category","user"));
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
        return view("admin.category.create",compact("user"));
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
            "nama"=>'required|min:3'
        ]);

        Category::create([
            "nama"=>$request->nama
        ]);

        return redirect()->route("category.index")->with("status","Data Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->permission == 0) {
            return redirect("home");
        }
        $user=User::where("id",Auth::id())->first();
        return view("admin.category.edit",compact("category","user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "nama"=>"required|min:3"
        ]);

        $category->update([
            "nama"=>$request->nama
        ]);

        return redirect()->route("category.index")->with("status","Data Berhasil Di Update!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route("category.index")->with("status","Data Berhasil Di Hapus!!!");
    }

    public function search(Request $request){
        $category=Category::where("nama",$request->search)->orwhere("nama",'like',"%".$request->search."%")->paginate(10);

        return view("admin.category.index",compact("category"));
    }
}
