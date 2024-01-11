<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    public $table = "jenis";
    public $primaryKey = "id_jenis";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_jenis", "tipe", "id_jenis_tipe", "status"];
}
