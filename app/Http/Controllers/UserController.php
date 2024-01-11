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

class UserController extends Controller
{
    public function getUserHomePage()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        $buku = Buku::all();
        $n = NonBuku::all();
        return view('user/userhome',['username' => $username,'user' => $user, "buku" => $buku, "n" => $n]);
    }

    public function getUserSearchPage()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        return view ('user/usersearch',['username' => $username,'user' => $user]);
    }

    public function getUserSearchPage2()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        return view ('user/usersearch2',['username' => $username,'user' => $user]);
    }

    public function getUserCartPage()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        $cart = cart::where('id_user','=', $user->id_user)->get();///
        return view('user/usercart',['username' => $username,'user' => $user,"cart" => $cart]);
    }

    public function getUserLibraryPage()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        $lib = library::where('id_user','=',$user->id_user)->get();
        $lib2 = listnonbuku::where('id_user','=',$user->id_user)->get();
        return view('user/library',['username' => $username,'user' => $user, "lib" => $lib, "lib2" => $lib2]);
    }

    public function getUserDetail()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        return view('user/details',['username' => $username,'user' => $user]);
    }

    public function getIsiSaldoPage(Request $request)
    {
        $user = Users::find($request->id_user);
        $param['user'] = $user;
        return view('user/isisaldo',$param);
    }

    public function isiSaldo(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->flash();
        $validate = $request->validate([
            'saldo' => 'required|numeric|min:0',
            'metode' => 'required',
            'pass' => 'required',
        ]);
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
                $trans_saldo->save();
                $user = users::find($id);
                $user->saldo = $data->saldo + $saldo;
                $user->save();
                return redirect('user/userhome');
            }
            else
            {
                return back()->with('err','Password salah');
            }
        }
        else
        {
            return back()->with('err','Gak ada');
        }
    }

    public function getEditUserPage(Request $request)
    {
        $user = Users::find($request->id_user);
        $param['user'] = $user;
        return view('user/edituser',$param);
    }

    public function editUser(Request $request)
    {
        $request->flash();
        $id = $request->input("id");
        $nama = $request->input("nama");
        $user = $request->input("user");
        $pass = $request->input("pass");
        $npass = $request->input("npass");
        $validate = $request->validate([
            "id" => "required",
            "nama" => "required",
            "user" => "required",
            "pass" => "required",
            "npass" => "required",
        ]);
        $res = Users::where('id_user','=', $id)->first();
        if($res)
        {
            if($res->password == Hash::check($pass, $res->password))
            {
                $data = Users::find($id);
                $data->nama = $nama;
                $data->username = $user;
                $data->password = bcrypt($npass);
                $data->save();
                return redirect('user/userhome');
            }
            else
            {
                return back()->with('err',"Password salah");
            }
        }
    }

    public function transaksiMemberPage(Request $request)
    {
        $user = Users::find($request->id_user);
        $param['user'] = $user;
        return view('user/transaksimember',$param);
    }

    public function beliMember(Request $request)
    {
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
                return response()->json(['error' => 'Saldo kurang']);
            }
            else
            {
                $user = users::find($id);
                $user->saldo = $user->saldo -= 300000;
                $user->users_id_role = 4;
                $user->save();
                $trans = new trans_saldo();
                $trans->id_user = $id;
                $trans->jumlah = 300000;
                $trans->metode = $metode;
                $trans->status = "Beli Member";
                $trans->created_at = $current_time;
                $trans->save();
                return redirect('user/userhome');
            }
        }
        else
        {
            return back()->with('err','Dicentang ya');
        }
    }

    public function batalMember(Request $request)
    {
        $id = Users::find($request->id_user);
        $id->users_id_role = 3;
        $id->saldo = $id->saldo += ((300000*20)/100);
        $id->save();
        return response()->json(['success' => 'Membership dibatalkan, anda mendapatkan refund']);
    }

    public function searchBuku(Request $request)
    {
        $search = $request->input('search');
        $buku = Buku::where('judul_buku', 'LIKE', '%' . $search . '%')->get();

        if ($buku->isNotEmpty()) {
            $updatedHtml = view('user/searchresult', compact('buku'))->render();
            return response()->json(['html' => $updatedHtml]);
        } else {
            return response()->json(['error' => 'No records found']);
        }
    }

    public function searchNonBuku(Request $request)
    {
        $search = $request->input('search');
        $nonbuku = NonBuku::where('nama', 'LIKE', '%' . $search . '%')->get();
        $updatedHtml = view('user/searchresult2', compact('nonbuku'))->render();

        return response()->json(['html' => $updatedHtml]);
    }

    public function detailBuku(Request $request)
    {
        $buku = Buku::find($request->id_buku);
        $param["buku"] = $buku;
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        return view('user/detailbuku',$param,["user" => $user]);
    }

    public function detailNonBuku(Request $request)
    {
        $nonbuku = NonBuku::find($request->id_alat_tulis);
        $param["nonbuku"] = $nonbuku;
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        return view('user/detailnonbuku',$param,["user" => $user]);
    }

    public function addToCartBook(Request $request)
    {
        $request->flash();
        $idbuku = $request->input('idbuku');
        $iduser = $request->input('iduser');
        //$idbuku = 5;
        $buku = Buku::find($idbuku);
        $id_user = Users::find($iduser);
        if ($id_user && $buku) {
            if ($id_user->users_id_role == 3) {
                $cart = new cart();
                $cart->id_user = $iduser;
                $cart->id_buku = $idbuku;
                $cart->id_nonbuku = 0;
                $cart->qty = 1;
                $cart->subtotal = $buku->harga_buku;
                $cart->save();
                //return back()->with('success','Masuk ke cart');
                $added = cart::find($cart->id);
                return response()->json(['data'=>$added],201);
            } else if ($id_user->users_id_role == 4) {
                $cart = new cart();
                $cart->id_user = $iduser;
                $cart->id_buku = $idbuku;
                $cart->id_nonbuku = 0;
                $cart->qty = 1;
                $cart->subtotal = $buku->harga_buku - (($buku->harga_buku * 20) / 100);
                $cart->save();
                //return back()->with('success','Masuk ke cart');
                $added = cart::where("id",'=',$cart->id)->first();
                return response()->json(['message' => '201, Buku masuk ke cart','data'=>$added],201);
            }
        } else {
            return back()->with('err','No data');
            //return response()->json(['error' => '500, User or book not found',"data" => ["id_user" => $iduser]], 500);
        }
    }

    public function addToCartNonBuku(Request $request)
    {
        $request->flash();
        $idalattulis = $request->input('idalattulis');
        $iduser = $request->input('iduser');
        $nonbuku = NonBuku::find($idalattulis);
        $id_user = Users::find($iduser);
        if ($id_user && $nonbuku) {
            if ($id_user->users_id_role == 3) {
                $cart = new cart();
                $cart->id_user = $iduser;
                $cart->id_buku = 0;
                $cart->id_nonbuku = $idalattulis;
                $cart->qty = 1;
                $cart->subtotal = $nonbuku->harga;
                $cart->save();
                return back()->with('success','Masuk ke cart');
            } else if ($id_user->users_id_role == 4) {
                $cart = new cart();
                $cart->id_user = $iduser;
                $cart->id_buku = 0;
                $cart->id_nonbuku = $idalattulis;
                $cart->qty = 1;
                $cart->subtotal = $nonbuku->harga - (($nonbuku->harga * 20) / 100);
                $cart->save();
                return back()->with('success','Masuk ke cart');
            }
        } else {
            return back()->with('err','No data');
        }
    }

    public function deleteFromCart(Request $request)
    {
        $cart = Cart::find($request->id);

        if ($cart) {
            $cart->delete();
            return response()->json(['success' => 'Cart deleted successfully']);
        } else {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }

    public function getCheckoutPage()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        $cart = cart::where('id_user','=', $user->id_user)->get();
        return view('user/checkout',['username' => $username,'user' => $user,"cart" => $cart]);
    }

    public function checkoutCart(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $current_time = date('Y-m-d H:i:s');
        $request->flash();
        $id = $request->input('id');
        $biaya = $request->input('biaya');
        $count = $request->input('count');
        $metode = $request->input('metode');
        $alamat = $request->input('alamat');
        $iduser = Users::where('id_user','=',$id)->first();
        $cart = cart::where('id_user','=',$id)->get();
        if($iduser->saldo < $biaya)
        {
            return back()->with('err','Uang tidak cukup');
        }
        else
        {
            $trans = new Transaksi();
            $trans->id_user = $id;
            $trans->qty = $count;
            $trans->subtotal = $biaya;
            $trans->metode = $metode;
            $trans->alamat = $alamat;
            $trans->tgl_beli = $current_time;
            $trans->save();

            $idbaru = $trans->id;
            foreach($cart as $res)
            {
                if($res->id_nonbuku == 0)
                {
                    $buku = new buku_trans();
                    $buku->id = $idbaru;
                    $buku->id_buku = $res->id_buku;
                    $buku->save();
                    $lib = new library();
                    $lib->id_buku = $res->id_buku;
                    $lib->id_user = $id;
                    $lib->save();
                    $counting = cart::where('id_buku','=', $res->id_buku)->count();
                    $bukudata = Buku::find($res->id_buku);
                    $bukudata->stok_buku -= $counting;
                    $bukudata->save();
                }
                else if($res->id_buku == 0)
                {
                    $nonbuku = new nonbuku_trans();
                    $nonbuku->id = $idbaru;
                    $nonbuku->id_nonbuku = $res->id_nonbuku;
                    $nonbuku->save();
                    $list = new listnonbuku();
                    $list->id_nonbuku = $res->id_nonbuku;
                    $list->id_user = $id;
                    $list->save();
                }
                $res->delete();
            }
            $user = Users::find($id);
            $user->saldo = $user->saldo - $biaya;
            $user->save();
            return redirect('user/userhome');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect("/login");
    }
}
