<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Users;
use App\Models\lamaran;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DateTime;

class MyController extends Controller
{
    public function home(){
        $b = new Buku();
        $dataBuku['dataBuku'] = $b->selectAllBuku();
        $random = Buku::inRandomOrder()
                ->limit(5)
                ->get();
        return view('home',[
            "dataBuku" => $dataBuku,
            "random" => $random
        ]);
    }

    public function login(){
        return view('login');
    }

    public function getAdminHomePage(){
        $lamaran = lamaran::where('status','=','pending')->get();
        return view('admin/adminhome',["lamaran" => $lamaran]);
    }

    public function register(){
        $r = new Roles();
        $param['dataroles'] = $r->selectAll();
        return view('register', $param);
    }

    public function showrole(){
        $r = new Roles();
        $param['dataroles'] = $r->selectAll();
        return view('showrole', $param);
    }

    public function simpanrole(Request $request){
        $name = $request->txtName;
        $r = new Roles();
        $r->tambahRole($name);

        return redirect('/showrole');
    }

    // public function showBuku(){
    //     $b = new Buku();
    //     $param['dataBuku'] = $b->selectAllBuku();
    //     return view('home', $param);
    // }    

    public function doLogin(Request $request)
    {
        $request->flash();
        $email = $request->input("txtEmail");
        $password = $request->input("txtPass");
        $check = $request->input('check');
        if (blank($email)) 
        {
            return back()->with('err', '-1 nama');
        }
        else if(blank($password))
        {
            return back()->with('err','password kosong');
        }
        else 
        {
            if($email == "admin" && $password == "admin")
            {
                return redirect('admin/adminhome');
            }
            else 
            {
                $res = Users::where('email','LIKE','%' . $email . '%')->first();
                if($res)
                {
                    if($res && Hash::check($password, $res->password))
                    {
                        $credential = [
                            'email' => $email,
                            'password' => $password,
                        ];

                        $remember = $check != null;

                        if(Auth::guard("web")->viaRemember() || Auth::guard("web")->attempt($credential, $remember))
                        {
                            if ($remember) {
                                $rememberToken = Auth::guard("web")->user()->getRememberToken();
                                $expiration = now()->addMinutes(5)->timestamp;
                                Cookie::queue(Cookie::make('remember_web', $rememberToken, $expiration));
                            }
                            
                            if($res->users_id_role == 1)
                            {
                                $username = Auth::guard("web")->user()->username;
                                return redirect('author/authorhome');
                            }
                            else if($res->users_id_role == 2)
                            {
                                $username = Auth::guard("web")->user()->username;
                                return redirect('cust/custhome');
                            }
                            else 
                            {
                                $username = Auth::guard("web")->user()->username;
                                return redirect('user/userhome');
                            }
                        }
                    }
                    else 
                    {
                        return back()->with('err','password salah')->with('enteredEmail', $email);
                    }
                }
                else 
                {
                    return back()->with('err','Kayaknya nggak pernah ada ini email');
                }
            }
        }
        return redirect('/login');
    }

    public function forgetpasspage($email)
    {
        $enteredEmail = session('enteredEmail');

        return view('forgetpass', ['enteredEmail' => $email]);
    }

    public function changepass(Request $request)
    {
        $email = $request->input("txtEmail");
        $password = $request->input("txtPass");

        $res = Users::where('email', 'LIKE', '%' . $email . '%')->first();

        if ($res) {
            $user = Users::where('email', $email)->first();
            
            if ($user) {
                $user->password = bcrypt($password);
                $user->save();
                
                return redirect('/login')->with('success', 'Password changed successfully');
            }
        }

        return back()->with('err', 'Failed to change password');
    }

    public function doRegister(Request $request)
    {
        $request->flash();
        $validate = $request->validate([
            "txtEmail" => "required|email",
            "txtNama" => "required",
            "txtUsername" => "required",
            "txtPass" => "required",
            "txtCpass" => "required",
            "txtDate" => "required|date",
        ]);
        $email = $request->input("txtEmail");
        $nama = $request->input("txtNama");
        $username = $request->input("txtUsername");
        $pass = $request->input("txtPass");
        $cpass = $request->input("txtCpass");
        $date = $request->input("txtDate");
        $roles = $request->input("cbRole");
        if($pass != $cpass)
        {
            return back()->with('err','Harus sama');
        }
        else
        {
            if(blank($email))
            {
                return back()->with('err','Email kosong');
            }
            else if(blank($nama))
            {
                return back()->with('err','Pw kosong');
            }
            else if(blank($username))
            {
                return back()->with('err','Pw kosong');
            }
            else if(blank($pass))
            {
                return back()->with('err','Pw kosong');
            }
            else if(blank($cpass))
            {
                return back()->with('err','Pw kosong');
            }
            else if(blank($date))
            {
                return back()->with('err','No tanggal');
            }
            else 
            {
                $res = Users::where('email','LIKE','%' . $email . '%')->first();
                if($res)
                {
                    return back()->with('err','Email udah ada');
                }
                else 
                {
                    $cust = users::where('users_id_role','=', 2)->count();
                    if($cust == 4)
                    {
                        return back()->with('err','Customer service full');
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
                        $res = $user->save();
                        if($res)
                        {
                            return redirect('login');
                        }
                    }
                }
            }
        }
    }

    public function logout(){
        if (Auth::guard("web")->check()){
            Auth::guard("web")->logout();
        }
        return redirect('login');
    }

    public function getDescriptionPage()
    {
        return view('description');
    }

    public function getAuthorHomePage()
    {
        $username = auth()->user()->username;
        return view('author/authorhome',['username' => $username]);
    }

    public function getCustHomePage()
    {
        $username = auth()->user()->username;
        $user = users::where('username', 'LIKE', '%' . $username . '%')->first();
        return view('cust/custhome',['username' => $username,'user' => $user]);
    }

    public function getUserHomePage()
    {
        $username = auth()->user()->username;
        $user = users::where('username','LIKE','%' . $username . '%')->first();
        return view('user/userhome',['username' => $username,'user' => $user]);
    }

    public function kirimLamaran(Request $request, int $id)
    {
        $user = users::find($request->id_user);
        $user->status = "pending";
        $lamaran = new lamaran();
        $lamaran->id_user = $user->id_user;
        $lamaran->status = 'pending';
        $lamaran->alasan = "-";
        $res = $lamaran->save();
        $rest = $user->save();
        if($res && $rest)
        {
            return back()->with('success','Lamaran terkirim');
        }
    }
}
