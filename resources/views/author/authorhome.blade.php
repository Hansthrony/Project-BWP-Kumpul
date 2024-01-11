@extends('layout/authorLayout')

@section('title', 'Author')

@section('navbar')

@endsection

@section('daftar')
    <div class="container">
        <br>
        <h1>Lihat Buku</h1>
        <hr>
        <div class="row">
            @foreach ($dataBuku as $buku)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('Image/' . $buku->gambar_buku) }}" style="height: 250px;"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $buku->judul_buku }}</h5>
                            <p class="card-text">Sinopsis : {{ $buku->sinopsis_buku }}</p>
                            <p class="card-text">Status : {{ $buku->status }}</p>
                            <a href="{{ url('author/authordetail/' . $buku->id_buku) }}"><input type="submit"
                                    name="btnDetail" id="btnDetail" value="Detail" class="btn btn-primary"></a>
                            <a href="{{ url('author/authorupdate/' . $buku->id_buku) }}"><input type="submit"
                                    name="btnUpdate" id="btnUpdate" value="Update" class="btn btn-primary"></a>
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
        </div>

        <h1 style="margin-top: 20px">Lihat Non Buku</h1>
        <hr style="margin-top: 10px; margin-bottom: 10px; "><br>
        <div class='container'>
            <div class="row">
                @foreach ($dataNonBuku as $item)
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('Image/' . $item->gambar) }}" style="height: 250px;"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Nama : {{ $item->nama }}</h5>
                                <p class="card-text">Harga : Rp. {{ $item->harga }},-</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<script src="http://code.jquery.com/jquery.js"></script>
<script language='javascript'>
    var myurl = "<?php echo URL::to('/'); ?>";

    function nonaktifkan(idbuku) {
        // alert(idbuku);
        // alert(myurl);
        $.get(myurl + "/nonaktifkan", {
                idbuku: idbuku
            },
            function(result) {
                alert(result);
                window.location.href = myurl + "/author/authorhome";
            }
        );
    }

    function aktifkan(idbuku) {
        // alert(idbuku);
        // alert(myurl);
        $.get(myurl + "/aktifkan", {
                idbuku: idbuku
            },
            function(result) {
                alert(result);
                window.location.href = myurl + "/author/authorhome";
            }
        );
    }
</script>
