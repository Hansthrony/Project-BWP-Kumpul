<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library extends Model
{
    use HasFactory;
    public $table = "library";
    public $primaryKey = "id_library";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id_library","id_buku","id_user"];

    public function users()
    {
        return $this->belongsTo(Users::class,'id_user','id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class,'id_buku','id_buku');
    }
}
