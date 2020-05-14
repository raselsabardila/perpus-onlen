<?php

namespace App\Http\Controllers;

use App\Peminjaman;
use Auth;
use App\User;
use Illuminate\Http\Request;

class laporan extends Controller
{
    public function index(){
        if (Auth::user()->permission == 0 ) {
            return redirect()->route("home");
        }

        $book=Peminjaman::latest()->paginate(10);
        $user=User::find(Auth::id());

        return view("admin.laporan.index",compact("user","book"));
    }
}
