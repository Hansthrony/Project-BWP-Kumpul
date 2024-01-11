<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DateTime;

class Users extends Authenticatable
{
    use HasFactory,Notifiable;
    public $table = "users";
    public $primaryKey = "id_user";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_user", "email", "nama", "tgl_lahir", "password", "saldo", "users_id_role", "status","username"];

    public function selectAllUsers(){
        $qry = Users::get();
        return $qry;
    }

    public function lamaran()
    {
        return $this->belongsTo(lamaran::class,'id_user','id_user');
    }

    public function roles()
    {
        return $this->belongsTo(Roles::class,'users_id_role','id_role');
    }

    public function Transaksi()
    {
        return $this->belongsTo(Transaksi::class,'id_user','id_user');
    }
}
