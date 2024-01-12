@extends('layout/adminLayout')

@section('title', 'Admin')

@section('navbar')

@endsection

@section('daftar')
    <h1>Lihat Semua Buku</h1>
    @foreach ($dataBuku as $buku)
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{ asset('Image/' . $buku->gambar_buku) }}" style="height: 250px;"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $buku->judul_buku }}</h5>
                    <p class="card-text">Sinopsis : {{ $buku->sinopsis_buku }}</p>
                    <p class="card-text">Status : {{ $buku->status }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection
