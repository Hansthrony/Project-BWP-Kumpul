<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    public $table = "genre";
    public $primaryKey = "id_genre";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_genre", "genre_buku"];

    public function selectAllGenre(){
        $qry = Genre::get();
        return $qry;
    }
}
