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
                    <a href="{{ url('author/authordetail/' . $buku->id_buku) }}"><input type="submit" name="btnDetail"
                            id="btnDetail" value="Detail" class="btn btn-primary"></a>
                    <a href="{{ url('author/authorupdate/' . $buku->id_buku) }}"><input type="submit" name="btnUpdate"
                            id="btnUpdate" value="Update" class="btn btn-primary"></a>
                    @if ($buku->status == 'Ready Stock')
                        <input type="button" name="btnNonActive" id="btnNonActive" value="Non-Active"
                            class="btn btn-danger" onclick="nonaktifkan({{ $buku->id_buku }})">
                    @else
                        <input type="button" name="btnActive" id="btnActive" value="Active" class="btn btn-success"
                            onclick="aktifkan({{ $buku->id_buku }})">
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endsection
