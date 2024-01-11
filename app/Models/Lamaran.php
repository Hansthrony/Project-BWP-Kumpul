<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lamaran extends Model
{
    use HasFactory;
    public $table = "lamaran_author";
    public $primaryKey = "id_lamaran";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_lamaran","id_user", "status", "alasan"];

    public function users()
    {
        return $this->belongsTo(users::class,'id_user','id_user');
    }
}
