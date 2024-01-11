@extends('layout/authorLayout')

@section('title', 'Update Buku')

@section('navbar')

@endsection

@section('daftar')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h1 width="40" size="20"> Update Buku</h1><br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('doUpdate') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-outline mb-4">
                                <p>Judul Buku : </p>
                                <input type="text" name="txtJudul" id="txtJudul" class="form-control form-control-lg"
                                    value="{{ $buku->judul_buku }}">
                                <input type="hidden" name="txtid" id="txtid" class="form-control form-control-lg"
                                    value="{{ $buku->id_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Gambar : </p>
                                <img class="card-img-top" src="{{ asset('Image/' . $buku->gambar_buku) }}"
                                    style="height: 200px; width:100px;" alt="Card image cap"><br><br>
                                <input type="file" name="gambar" id="gambar" class="form-control form-control-lg">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Sinopsis : </p>
                                <input type="text" name="txtSinopsis" id="txtSinopsis"
                                    class="form-control form-control-lg" value="{{ $buku->sinopsis_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Isi : </p>
                                <input type="text" name="txtIsi" id="txtIsi" class="form-control form-control-lg"
                                    value="{{ $buku->isi_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Harga : </p>
                                <input type="text" name="txtHarga" id="txtHarga" class="form-control form-control-lg"
                                    value="{{ $buku->harga_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Halaman : </p>
                                <input type="text" name="txtHalaman" id="txtHalaman" class="form-control form-control-lg"
                                    value="{{ $buku->halaman_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Stock : </p>
                                <input type="text" name="txtStock" id="txtStock" class="form-control form-control-lg"
                                    value="{{ $buku->stok_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Tanggal Terbit : </p>
                                <input type="date" name="tgl" id="tgl" class="form-control form-control-lg"
                                    value="{{ $buku->tanggal_buku_terbit }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Lebar Buku : </p>
                                <input type="text" name="txtLebar" id="txtLebar" class="form-control form-control-lg"
                                    value="{{ $buku->lebar_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Panjang Buku : </p>
                                <input type="text" name="txtPanjang" id="txtPanjang" class="form-control form-control-lg"
                                    value="{{ $buku->panjang_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Rating Buku : </p>
                                <input type="text" name="txtRating" id="txtRating" class="form-control form-control-lg"
                                    value="{{ $buku->rating_buku }}">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Genre Buku : </p>
                                <select name="cbGenre" id="cbGenre" class="form-control form-control-lg">
                                    @foreach ($genre as $rowg)
                                        @if ($rowg->id_genre == $buku->buku_id_genre)
                                            <option selected value="{{ $rowg->id_genre }}">{{ $rowg->genre_buku }}
                                            </option>
                                        @else
                                            <option value="{{ $rowg->id_genre }}">{{ $rowg->genre_buku }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="Update" name="btnUpload" class="btn btn-primary btn-lg btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
