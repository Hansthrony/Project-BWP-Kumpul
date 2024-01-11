<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trans_saldo extends Model
{
    use HasFactory;
    public $table = "trans_saldo";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id", "id_user", "jumlah", "metode", "status","created_at"];

    public function users()
    {
        return $this->belongsTo(Users::class,'id_user','id_user');
    }
}
