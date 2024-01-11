<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public $table = "roles";
    public $primaryKey = "id_role";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ["id_role", "nama_role"];

    public function selectAll(){
        $qry = Roles::get();
        return $qry;
    }

    public function tambahRole($name){
        $baru = new Roles();
        //$baru->id_role = 0;
        $baru->nama_role = $name;
        $baru->save();
    }
}
