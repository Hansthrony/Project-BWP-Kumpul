<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Users;
use App\Models\library;
use App\Models\listnonbuku;
use App\Models\NonBuku;
use App\Models\trans_saldo;
use App\Models\buku_trans;
use App\Models\nonbuku_trans;
use App\Models\Transaksi;
use App\Models\cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DateTime;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    // Untuk test, semua data tidak masuk db untuk tidak merusak struktur, data dimasukkan kedalam temp array session 
    private function getData(Request $request)
    {
        if (!Session::has('data')) {
            $data = [];
            Session::put('data', $data);

            return $data;
        }

        $data = Session::get('data');
        if (gettype($data) !== 'array') {
            $data = [];
            Session::put('data', $data);

            return $data;
        }

        return $data;
    }

    public function lihatSemuaUser()
    {
        $users = Users::all();
        return response()->json(['status' => 200,'users' => $users], 200);
    }

    public function tesAddUser(Request $request)
    {
        $email = $request->input("txtEmail");
        $nama = $request->input("txtNama");
        $username = $request->input("txtUsername");
        $pass = $request->input("txtPass");
        $cpass = $request->input("txtCpass");
        $date = $request->input("txtDate");
        $roles = $request->input("cbRole");
        if($pass != $cpass)
        {
            return response()->json(['status' => 400, 'message' => 'Konfirmasi Password Tidak Sama'],400);
        }
        else 
        {
            if(blank($email) || blank($nama) || blank($username) || blank($pass) || blank($cpass) || blank($date))
            {
                return response()->json(['status' => 400, 'message' => 'Terdapat field yang kosong'],400);
            }
            else 
            {
                $cust = Users::where('username','LIKE', '%' . $username . '%')->first();
                if($cust)
                {
                    return response()->json(['status' => 400, 'message' => 'Username Udah Ada'],400);
                }
                else 
                {
                    $user = new users();
                    $user->email = $email;
                    $user->nama = $nama;
                    $user->username = $username;
                    $user->password = bcrypt($pass);
                    $user->tgl_lahir = $date;
                    $user->users_id_role = $roles;
                    if($roles == 2)
                    {

                        $user->status = "-";
                    }
                    else 
                    {
                        $user->status = "active";
                    }
                    $user->saldo = 0;
                    $data = $this->getData($request);
                    array_push($data,$user);
                    $request->session()->put('data',$data);
                    return response()->json(['status' => 201, "data" => $data],201);
                }
            }
        }
    }

    public function tesLogin(Request $request)
    {
        $email = $request->input("txtEmail");
        $pass = $request->input("txtPass");
        if(blank($email) || blank($pass))
        {
            return response()->json(['status' => 400, 'message' => 'Terdapat field yang kosong'],400);
        }
        else 
        {
            if($email == "admin" && $pass == "admin")
            {
                return response()->json(['status' => 200, "message" => "Admin"],200);
            }
            else 
            {
                $res = Users::where('email','LIKE','%' . $email . '%')->first();
                if($res)
                {
                    if($res && Hash::check($pass, $res->password))
                    {
                        if($res->users_id_role == 1)
                        {
                            return response()->json(['status' => 200, "message" => "Author", "res" => $res],200);
                        }
                        else if($res->users_id_role == 3)
                        {
                            return response()->json(['status' => 200, "message" => "User", "res" => $res],200);
                        }
                        else if($res->users_id_role == 4)
                        {
                            return response()->json(['status' => 200, "message" => "User Plus", "res" => $res],200);
                        }
                    }
                    else 
                    {
                        return response()->json(['status' => 400, "message" => "Password Salah"],400);
                    }
                }
                else 
                {
                    return response()->json(['status' => 404, "message" => "No data"],404);
                }
            }
        }
    }
    //Tadi tes untuk logres sekarang crud 
    // Sekarang masuk user, untuk test majority kebanyakan

    public function lihatDataUser(Request $request)
    {
        $datauser = [];
        $request->flash();
        $id = $request->input("id");
        $user = Users::find($id);
        if($user)
        {
            $datauser = $user;
            return response()->json(['status' => 200, "datauser" => $datauser],200);
        }
        else 
        {
            return response()->json(['status' => 404, "message" => "No data"],404);
        }
    }

    public function isiSaldo(Request $request)
    {
        $trans = [];
        $result_user = [];
        date_default_timezone_set('Asia/Jakarta');
        $request->flash();
        $id = $request->input('id');
        $saldo = $request->input('saldo');
        $metode = $request->input('metode');
        $pass = $request->input('pass');
        $data = Users::where('id_user','=', $id)->first();
        if($data)
        {
            if($data->password == Hash::check($pass, $data->password))
            {
                $current_time = date('Y-m-d H:i:s');
                $trans_saldo = new trans_saldo();
                $trans_saldo->id_user = $id;
                $trans_saldo->jumlah = $saldo;
                $trans_saldo->metode = $metode;
                $trans_saldo->status = "Top Up Saldo";
                $trans_saldo->created_at = $current_time;
                $trans = $trans_saldo;
                $user = users::find($id);
                $user->saldo = $data->saldo += $saldo;
                $result_user = $user;
                return response()->json(['status' => 200, "trans" => $trans, "result_user" => $result_user],200);
            }
            else 
            {
                return response()->json(['status' => 400, "message" => "Pw Salah"],400);
            }
        }
        else 
        {
            return response()->json(['status' => 404, "message" => "No data"],404);
        }
    }

    public function buymember(Request $request)
    {
        $user_result = [];
        $result = [];
        date_default_timezone_set('Asia/Jakarta');
        $current_time = date('Y-m-d H:i:s');
        $request->flash();
        $id = $request->input('id');
        $metode = $request->input('metode');
        $check = $request->input('check');
        if($check != null)
        {
            $iduser = Users::find($id);
            if($iduser->saldo < 300000)
            {
                return response()->json(['status' => 400, "message" => "Saldo Kurang bang"],400);
            }
            else 
            {
                if($iduser->users_id_role == 4)
                {
                    return response()->json(['status' => 400, "message" => "SUDAH MEMBER INI"],400);
                }
                else {
                    $user = users::find($id);
                    $user->saldo = $user->saldo -= 300000;
                    $user->users_id_role = 4;
                    $user_result = $user;
                    $trans = new trans_saldo();
                    $trans->id_user = $id;
                    $trans->jumlah = 300000;
                    $trans->metode = $metode;
                    $trans->status = "Beli Member";
                    $trans->created_at = $current_time;
                    $result = $trans;
                    return response()->json(['status' => 200, "result" => $result, "user_result" => $user_result],200);
                }
            }
        }
        else 
        {
            return response()->json(['status' => 400, "message" => "Dicentang ya"],400);
        }
    }

    public function showAllBook()
    {
        $buku = buku::all();
        return response()->json(['status' => 200, "buku" => $buku],200);
    }

    public function tesAddBook(Request $request)
    {
        $result = [];
        $validatedData = $request->validate([
            'txtJudul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
            'txtSinopsis' => 'required',
            'txtIsi' => 'required',
            'txtHarga' => 'required',
        ]);

        if ($request->hasFile('gambar')){
            $foto = $request->file('gambar');
            $namafile = $foto->getClientOriginalName();
            $foto->move('Image',$namafile);
        }

        $buku = new Buku([
            'judul_buku' => $request->input('txtJudul'),
            'gambar_buku' => $namafile,
            'sinopsis_buku' => $request->input('txtSinopsis'),
            'isi_buku' => $request->input('txtIsi'),
            'harga_buku' => $request->input('txtHarga'),
            'halaman_buku' => $request->input('txtHalaman'),
            'stok_buku' => $request->input('txtStock'),
            'tanggal_buku_terbit' => $request->input('tgl'),
            'lebar_buku' => $request->input('txtLebar'),
            'panjang_buku' => $request->input('txtPanjang'),
            'rating_buku' => $request->input('txtRating'),
            'buku_id_genre' => $request->input('cbGenre'),
            'status' => $request->input('cbStatus'),
            'users_id_user' => Auth::user()->id_user,
        ]);
        $result = $buku;
        return response()->json(['status' => 200, "result" => $result],200);
    }
}
