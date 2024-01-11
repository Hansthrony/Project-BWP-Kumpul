<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    use HasFactory;
    public $table = "pre_order";
    public $primaryKey = "id_preorder";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_preorder", "buku_id_buku", "harga_awal", "status_preorder"];

    public function buku()
    {
        return $this->belongsTo(buku::class,'buku_id_buku','id_buku');
    }
}
