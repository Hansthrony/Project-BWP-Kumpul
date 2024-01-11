@extends('layout/userlayout')

@section('title', 'User')

@section('navbar')

@endsection

@section('daftar')
<h1>Lihat hasil belanja</h1>
<p>Reminder, apa yang sudah dibeli tidak bisa dikembalikan</p>
<div>
    <table class="table table">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
        </tr>
        @foreach ($lib2 as $key => $res)
            <tr>
                <td>{{$key+1}}</td>
                <td><img src="{{$res->gambar}}" alt=""></td>
                <td>{{$res->nonbuku->nama}}</td>
            </tr>
        @endforeach
    </table>
</div>
<hr>
<div>
    <div class="row">
        @foreach($lib as $book)
            <div class="col-md-2">
                <div class="card" style="margin-bottom: 20px; border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                    {{-- <img src="{{ $book->buku->gambar_buku }}" class="card-img-top" alt="{{ $book->buku->judul_buku }}" width="" height="250px"> --}}
                    <img class="card-img-top" src="{{ asset('Image/' . $book->buku->gambar_buku) }}" style="height: 250px;"
                            alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{ $book->buku->users->nama }}</p>
                        <h5 class="card-title">{{ $book->buku->judul_buku }}</h5>
                        <p class="card-text text-primary">Rp. {{ $book->buku->harga_buku }}</p>
                        <a href="{{route('detail-buku',['id_buku' => $book->buku->id_buku])}}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
