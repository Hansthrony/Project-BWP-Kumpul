@extends('layout/authorLayout')

@section('title', 'Upload Non-Buku')

@section('navbar')

@endsection

@section('daftar')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h1 width="40" size="20"> Upload Non-Buku</h1><br>
                        <form action="{{ route('doUploadNonBook') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-outline mb-4">
                                <p>Nama Barang : </p>
                                <input type="text" name="txtNama" id="txtNama" class="form-control form-control-lg">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Gambar : </p>
                                <input type="file" name="gambar" id="gambar" class="form-control form-control-lg">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Harga Barang : </p>
                                <input type="text" name="txtHarga" id="txtHarga" class="form-control form-control-lg">
                            </div>
                            <div class="form-outline mb-4">
                                <p>Status Barang : </p>
                                <select name="cbStatus" id="cbStatus" class="form-control form-control-lg">
                                    <option value="Ready Stock">Ready Stock</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                            <input type="submit" value="Upload" name="btnUpload" class="btn btn-primary btn-lg btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
