<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $table = "transaksi";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id", "id_user", "qty", "subtotal", "metode", "tgl_beli","alamat"];

    public function users()
    {
        return $this->belongsTo(Users::class,'id_user','id_user');
    }
}
