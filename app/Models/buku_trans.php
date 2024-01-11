<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku_trans extends Model
{
    use HasFactory;
    public $table = "buku_trans";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ["id","id_buku"];
}
