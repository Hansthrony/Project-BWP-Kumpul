<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Users;
use App\Models\lamaran;
use App\Models\NonBuku;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DateTime;

class AuthorController extends Controller
{
    public function authordetail($id)
    {
        $b = new Buku();
        $param['buku'] = $b->getBukuByID($id);
        //print_r($param['buku']);
        return view('author/authordetail', $param);
    }

    public function authorupdate($id)
    {
        $b = new Buku();
        $g = new Genre();
        $param['buku'] = $b->getBukuByID($id);
        $param['genre'] = $g->selectAllGenre();
        return view('author/authorupdate', $param);
    }

    public function nonaktifkan(Request $req)
    {
        $idbuku = $req->idbuku;
        $b = new Buku();
        $b->nonaktifkan($idbuku);
        echo "Success";
    }

    public function aktifkan(Request $req)
    {
        $idbuku = $req->idbuku;
        $b = new Buku();
        $b->aktifkan($idbuku);
        echo "Success";
    }

    public function doDelete($id)
    {
        $book = Buku::find($id);

        if ($book) {
            $book->delete();
        }
        return redirect()->route('author-book');
    }

    public function getAuthorDetail()
    {
        $buku = new Buku();
        $param['dataBuku'] = $buku->getBuku();
        return view('author/authordetail', $param);
    }

    public function authorUploadBook()
    {
        $g = new Genre();
        $param['genre'] = $g->selectAllGenre();
        return view('author/authorupload', $param);
    }

    public function authorNonBook()
    {
        return view('author/authornonbuku');
    }

    public function doUpload(Request $request)
    {
        $validatedData = $request->validate([
            'txtJudul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
            'txtSinopsis' => 'required',
            'txtIsi' => 'required',
            'txtHarga' => 'required',
            'txtHalaman' => 'required',
            'txtStock' => 'required',
            'tgl' => 'required',
            'txtLebar' => 'required',
            'txtPanjang' => 'required',
            'txtRating' => 'required',
            'cbGenre' => 'required',
            'cbStatus' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $namafile = $foto->getClientOriginalName();
            $foto->move('Image', $namafile);
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
        $buku->save();
        return redirect()->back()->with('success', 'Upload Buku Berhasil!');
    }

    public function doUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'txtJudul' => 'required',
            'txtSinopsis' => 'required',
            'txtIsi' => 'required',
            'txtHarga' => 'required',
            'txtHalaman' => 'required',
            'txtStock' => 'required',
            'tgl' => 'required',
            'txtLebar' => 'required',
            'txtPanjang' => 'required',
            'txtRating' => 'required',
            'cbGenre' => 'required',
        ]);

        $buku = Buku::find($request->txtid);

        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $namafile = $foto->getClientOriginalName();
            $foto->move('Image', $namafile);
            $buku->gambar_buku = $namafile;
        }

        $buku->judul_buku = $request->input('txtJudul');
        $buku->sinopsis_buku = $request->input('txtSinopsis');
        $buku->isi_buku = $request->input('txtIsi');
        $buku->harga_buku = $request->input('txtHarga');
        $buku->halaman_buku = $request->input('txtHalaman');
        $buku->stok_buku = $request->input('txtStock');
        $buku->tanggal_buku_terbit = $request->input('tgl');
        $buku->lebar_buku = $request->input('txtLebar');
        $buku->panjang_buku = $request->input('txtPanjang');
        $buku->rating_buku = $request->input('txtRating');
        $buku->buku_id_genre = $request->input('cbGenre');

        $buku->save();
        return redirect()->back()->with('success', 'Update Buku Berhasil!');
    }

    public function getBookUser()
    {
        $b = new Buku();
        $nb = new NonBuku();
        $param['dataBuku'] = $b->getBuku();
        $param['dataNonBuku'] = $nb->getNonBook();
        return view('author/authorhome', $param);
    }

    public function doUploadNonBook(Request $request)
    {
        $validatedData = $request->validate([
            'txtNama' => 'required',
            'txtHarga' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $namafile = $foto->getClientOriginalName();
            $foto->move('Image', $namafile);
        }

        $NonBuku = new NonBuku([
            'nama' => $request->input('txtNama'),
            'harga' => $request->input('txtHarga'),
            'status' => $request->input('cbStatus'),
            'id_user' => Auth::user()->id_user,
            'gambar' => $namafile,
        ]);
        $NonBuku->save();
        return redirect()->back()->with('success', 'Upload Barang Berhasil!');
    }

    public function logout(){
        Auth::logout();
        return redirect("/login");
    }
}
