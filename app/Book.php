<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=["judul","kategori_id","keterangan","sampul","ebook","user_id","status","status_peminjaman"];

    public function kategori(){
        return $this->belongsTo("App\Category","kategori_id");
    }

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }
}
