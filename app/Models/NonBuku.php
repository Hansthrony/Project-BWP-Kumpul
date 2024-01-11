<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NonBuku extends Model
{
    use HasFactory;
    public $table = "non_buku";
    public $primaryKey = "id_alat_tulis";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_alat_tulis", "nama","harga", "status","id_user","gambar"];

    public function getNonBook(){
        $qry = NonBuku::where('id_user', Auth::user()->id_user)->get();
        return $qry;
    }
}
