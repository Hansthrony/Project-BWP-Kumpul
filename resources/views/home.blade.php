@extends('layout/layout')

@section('title', 'Home')

@section('navbar')

@endsection

@section('carousel')

@endsection

@section('daftar')
    <h1>Recommended Book</h1>
    @foreach($dataBuku['dataBuku'] as $book)
        <div class="col-md-2">
            <div class="card" style="margin-bottom: 20px; border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                <img class="card-img-top" src="{{ asset('Image/' . $book->gambar_buku) }}" style="height: 250px;"
                            alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->judul_buku }}</h5>
                    <p class="card-text">{{ $book->sinopsis_buku }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection
