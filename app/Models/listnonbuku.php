<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listnonbuku extends Model
{
    use HasFactory;
    public $table = "listnonbuku";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id","id_nonbuku","id_user"];

    public function users()
    {
        return $this->belongsTo(Users::class,'id_user','id_user');
    }

    public function NonBuku()
    {
        return $this->belongsTo(NonBuku::class,'id_nonbuku','id_alat_tulis');
    }
}
