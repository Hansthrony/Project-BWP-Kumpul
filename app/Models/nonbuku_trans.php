<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nonbuku_trans extends Model
{
    use HasFactory;
    public $table = "nonbuku_trans";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id","id_nonbuku"];

    public function NonBuku()
    {
        return $this->belongsTo(NonBuku::class,'id_nonbuku','id_alat_tulis');
    }
}
