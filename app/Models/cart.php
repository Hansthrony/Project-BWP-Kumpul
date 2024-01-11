<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    public $table = "cart";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id", "id_user", "id_buku", "id_nonbuku", "qty","subtotal"];

    public function users()
    {
        return $this->belongsTo(Users::class,'id_user','id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class,'id_buku','id_buku');
    }

    public function NonBuku()
    {
        return $this->belongsTo(NonBuku::class,'id_nonbuku','id_alat_tulis');
    }
}
