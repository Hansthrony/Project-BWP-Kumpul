<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Buku extends Model
{
    use HasFactory;
    public $table = "buku";
    public $primaryKey = "id_buku";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_buku","id_role", "judul_buku", "gambar_buku", "users_id_user","sinopsis_buku", "isi_buku", "harga_buku", "halaman_buku", "stok_buku", "tanggal_buku_terbit", "lebar_buku", "panjang_buku", "rating_buku", "buku_id_genre", "status"];

    public function selectAllBuku(){
        $qry = Buku::get();
        return $qry;
    }

    public function users()
    {
        return $this->belongsTo(Users::class,'users_id_user','id_user');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class,'buku_id_genre','id_genre');
    }

    public function getBuku(){
        $qry = Buku::where('users_id_user', Auth::user()->id_user)->get();
        return $qry;
    }

    public function getBukuByID($id){
        $qry = Buku::where('id_buku', $id)->get();
        foreach ($qry as $row) {
            return $row;
        }
        return null;
    }

    public function nonaktifkan($idbuku) {
        Buku::where('id_buku', '=', $idbuku)
            ->update(['status'=> 'Nonaktif']);
    }

    public function aktifkan($idbuku) {
        Buku::where('id_buku', '=', $idbuku)
            ->update(['status'=> 'Ready Stock']);
    }
}
