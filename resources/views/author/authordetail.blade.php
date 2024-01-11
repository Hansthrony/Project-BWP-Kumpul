@extends('layout/authorLayout')

@section('title', 'Detail')

@section('navbar')

@endsection

@section('daftar')
    <div class="container">
        <br>
        <h1>Detail</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <img class="card-img-top" src="{{ asset("Image/".$buku->gambar_buku)}}" style="height: 650px;" alt="Card image cap">
            </div>
            <div class="col-md-6">
                <h5>Judul : {{$buku->judul_buku}}</h5>
                <h6>Sinopsis : {{$buku->sinopsis_buku}}</h6>
                <br>
                <p><b>Isi Buku</b></p>
                <p>{{$buku->isi_buku}}</p>
                <p><b>Deskripsi</b></p>
                <p>Jumlah Halaman : {{$buku->halaman_buku}}</p>
                <p>Tanggal Terbit : {{$buku->tanggal_buku_terbit}}</p>
                <p>Ukuran Buku : {{$buku->panjang_buku}}cm X {{$buku->lebar_buku}}cm</p>
                <p>Rating Buku : {{$buku->rating_buku}}</p>
                <p><b>Harga : Rp. {{$buku->harga_buku}},-</b></p>
            </div>
        </div>
    </div>
@endsection
