<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Users;
use App\Models\NonBuku;
use App\Models\lamaran;
use App\Models\Transaksi;
use App\Models\trans_saldo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DateTime;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function getAdminHomePage(){
        $lamaran = lamaran::where('status','=','pending')->get();
        return view('admin/adminhome',["lamaran" => $lamaran]);
    }

    public function getAdminUserPage(){
        $data = Users::all();
        return view('admin/adminuser',compact('data'));
    }

    public function getAdminBukuPage(){
        $b = new Buku();
        $param['dataBuku'] = $b->selectAllBuku();
        return view('admin/adminbuku',$param);
    }

    public function getAdminTransaksiPage()
    {
        $trans = Transaksi::all();
        $transsaldo = trans_saldo::all();
        return view('admin/admintransaksi',compact('trans'),compact('transsaldo'));
    }

    public function getAdminTestPage()
    {
        return view('admin/test');
    }

    public function detailLamaran(Request $request)
    {
        $data = lamaran::find($request->id_lamaran);
        $param["data"] = $data;
        $datauser = users::join('roles','id_role', '=', 'users_id_role')
        ->where('id_user',$data->id_user)
        ->get();
        $param["datauser"] = $datauser;
        return view('admin/viewlamaran',$param);
    }

    public function acceptOrReject(Request $request)
    {
        $action = $request->input('action');
        $alasan = $request->input('alasan');
        $actionParts = explode('-', $action);
        $aksi = reset($actionParts);
        $id_lamaran = end($actionParts);
        $id = lamaran::find($id_lamaran);
        switch ($aksi)
        {
            case 'accept':
                $id->status = 'Accepted';
                $res = $id->save();
                if($res)
                {
                    return redirect('admin/adminhome');
                }
                break;
            case 'reject':
                if(blank($alasan))
                {
                    return back()->with('err','Harus ada alasan untuk menolak');
                }
                else
                {
                    $id = lamaran::find($request->id_lamaran);
                    $id->status = 'Rejected';
                    $id->alasan = $alasan;
                    $res = $id->save();
                    if($res)
                    {
                        return redirect('admin/adminhome');
                    }
                }
                break;
        }
    }

    public function toggleUser(Request $request)
    {
        $id = Users::find($request->id_user);
        if (!$id) {
            return response()->json(['error' => 'User not found']);
        }
        if($id->status == "active")
        {
            $id->status = "inactive";
            $res = $id->save();
            if($res)
            {
                $data = Users::all();
                $updatedHtml = View::make('admin/datatable', compact('data'))->render();
                return response()->json(['success' => 'User di-nonaktifkan', 'html' => $updatedHtml]);
            }
        }
        else if($id->status == "inactive")
        {
            $id->status = "active";
            $res = $id->save();
            if($res)
            {
                $data = Users::all();
                $updatedHtml = View::make('admin/datatable', compact('data'))->render();
                return response()->json(['success' => 'User di-aktifkan', 'html' => $updatedHtml]);
            }
        }
    }

    public function trans()
    {

    }
}
