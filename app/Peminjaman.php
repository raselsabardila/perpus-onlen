<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable=["buku_id","peminjam"];

    protected $table="peminjamans_tabel";

    public function peminjam_buku(){
        return $this->belongsTo("App\User","peminjam");
    }

    public function buku(){
        return $this->belongsTo("App\Book","buku_id");
    } 
}
