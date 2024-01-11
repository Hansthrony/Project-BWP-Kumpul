<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="/jquery.min.js"></script>
    <script src="/jquery.form.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            margin-top: 2%;
        }

        .row1 {
            border: 1px solid black;
            width: 80%;
            height: 580px;
            margin-top: 25%;
            margin-right: 2%;
            overflow-y: auto;
        }

        .row2 {
            border: 1px solid black;
            width: 80%;
            height: 580px;
            margin-top: 25%;
            margin-right: 2%;
            overflow-y: auto;
        }

        .row3 {
            border: 1px solid black;
            width: 80%;
            height: 580px;
            margin-top: 25%;
            margin-right: 2%;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <h3 class="text-center">Test web service</h3>
    <a href="{{route('admin-home')}}">Kembali</a>
    <hr>
    <div class="container">
        <div class="row1">
            <p>1. Test user</p>
            <form action="{{route('lihat-semua-user')}}" method="post">
                @csrf
                <p>1. Lihat semua user : </p>
                <input type="submit" value="Execute" name="exec" class="btn btn-outline-success">
            </form>
            <hr>
            <form action="{{ route('tes-add-user')}}" method="post">
                @csrf
                <h4 style="text-align:center;margin-top:10px;">2. Register User</h4>
                Email : 
                <input type="text" name="txtEmail" id="txtEmail" class="form-control"><br>
                Nama : 
                <input type="text" name="txtNama" id="txtNama" class="form-control"><br>
                Username : 
                <input type="text" name="txtUsername" id="txtUsername" class="form-control"><br>
                Password : 
                <input type="password" name="txtPass" id="txtPass" class="form-control"><br>
                Confirm Password : 
                <input type="password" name="txtCpass" id="txtCpass" class="form-control"><br>
                Tanggal Lahir : 
                <input type="date" name="txtDate" id="txtDate" class="form-control"><br>
                Role : 
                <select name="cbRole" id="cbRole" class="form-control">
                    <option value="1">Author</option>
                    <option value="3">Normal Customer</option>
                </select><br>
                <input type="submit" value="Register" class="btn btn-outline-primary"><br>
            </form>
            <hr>
            <form action="{{ route('tes-login') }}" method="post">
                @csrf
                <h4 style="text-align:center;margin-top:10px;">3. Login User</h4>
                <div class="form-outline mb-4">
                    <p>Email : </p>
                    <input type="text" name="txtEmail" id="txtEmail" class="form-control form-control-lg">
                </div>
                <div class="form-outline mb-4">
                    <p>Password : </p>
                    <input type="text" name="txtPass" id="txtPass" class="form-control form-control-lg">
                </div>
                <input type="submit" value="Login" name="btnLogin" class="btn btn-outline-primary">
            </form>
        </div>
        <div class="row2">
            <p>2. Test CRUD Author</p>
            <form action="{{route('show-all-book')}}" method="post">
                @csrf
                <p>1. Lihat semua buku : </p>
                <input type="submit" value="Execute" name="exec" class="btn btn-outline-success">
            </form>
            <hr>
            <form action="{{route('tes-add-book')}}" method="post">
                @csrf 
                <p>Tes Add Book</p>
                <form action="{{ route('doUpload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-outline mb-4">
                        <p>Judul Buku : </p>
                        <input type="text" name="txtJudul" id="txtJudul" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Gambar : </p>
                        <input type="file" name="gambar" id="gambar" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Sinopsis : </p>
                        <input type="text" name="txtSinopsis" id="txtSinopsis" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Isi : </p>
                        <input type="text" name="txtIsi" id="txtIsi" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Harga : </p>
                        <input type="text" name="txtHarga" id="txtHarga" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Halaman : </p>
                        <input type="text" name="txtHalaman" id="txtHalaman" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Stock : </p>
                        <input type="text" name="txtStock" id="txtStock" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Tanggal Terbit : </p>
                        <input type="date" name="tgl" id="tgl" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Lebar Buku : </p>
                        <input type="text" name="txtLebar" id="txtLebar" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Panjang Buku : </p>
                        <input type="text" name="txtPanjang" id="txtPanjang" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Rating Buku : </p>
                        <input type="text" name="txtRating" id="txtRating" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Genre Buku : </p>
                        <select name="cbGenre" id="cbGenre" class="form-control form-control-lg">
                            <option value="1">Agama Islam</option>
                            <option value="2">Agama Kristen</option>
                            <option value="3">Agama Katolik</option>
                            <option value="4">Agama Hindu</option>
                            <option value="5">Agama Buddha</option>
                            <option value="6">Agama Konghucu</option>
                            <option value="7">Fauna</option>
                            <option value="8">Flora</option>
                            <option value="9">Geography</option>
                            <option value="10">History</option>
                            <option value="11">Technology</option>
                        </select>
                    </div>
                    <div class="form-outline mb-4">
                        <p>Status Buku : </p>
                        <select name="cbStatus" id="cbStatus" class="form-control form-control-lg">
                            <option value="Ready Stock">Ready Stock</option>
                            <option value="Stock Tidak Ready">Stock Tidak Ready</option>
                        </select>
                    </div>
                    <input type="submit" value="Upload" name="btnUpload" class="btn btn-primary btn-lg btn-block">
                </form>
            </form>
        </div>
        <div class="row3">
            <p>3. Test User</p>
            <form action="{{route('lihat-data-user')}}" method="post">
                @csrf 
                <p>Cek user ada apa kagak</p>
                <p>ID : </p>
                <input type="text" name="id" id=""> <br> <br>
                <input type="submit" value="Cek" class="btn btn-outline-primary">
            </form>
            <hr>
            <form action="{{route('isi-saldo')}}" method="post">
                @csrf 
                <p>Isi saldo</p>
                <div class="form-outline mb-4">
                    <p>Id User : </p>
                    <input type="text" name="id" id="id" class="form-control form-control-lg">
                </div>
                <div class="form-outline mb-4">
                    <p>Saldo : </p>
                    <input type="text" name="saldo" id="saldo" class="form-control form-control-lg">
                </div>
                <div class="form-outline mb-4">
                    <p>Metode Pembayaran : </p>
                    <select name="metode" id="metode" class="form-control form-control-lg">
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="BTN">BTN</option>
                        <option value="Gopay">Gopay</option>
                        <option value="OVO">OVO</option>
                        <option value="Kredit">Kredit</option>
                        <option value="Black Card">Black Card :D</option>
                    </select>
                </div>
                <div class="form-outline mb-4">
                    <p>Password : </p>
                    <input type="text" name="pass" id="pass" class="form-control form-control-lg">
                </div>
                <input type="submit" value="Top Up" name="topup" class="btn btn-outline-primary">
            </form>
            <hr>
            <form action="{{route('buy')}}" method="post">
                @csrf 
                <div class="form-outline mb-4">
                    <p>Id User : </p>
                    <input type="text" name="id" id="id" class="form-control form-control-lg">
                </div>
                <div class="form-outline mb-4">
                    <p>Metode Pembayaran : </p>
                    <select name="metode" id="metode" class="form-control form-control-lg">
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="BTN">BTN</option>
                        <option value="Gopay">Gopay</option>
                        <option value="OVO">OVO</option>
                        <option value="Kredit">Kredit</option>
                        <option value="Black Card">Black Card :D</option>
                    </select>
                </div>
                <input type="checkbox" name="check" id="check"> Saya menyetujui semua terms and service untuk pembelian Member ini <br> <br>
                <input type="submit" value="Top Up" name="topup" class="btn btn-outline-primary">
            </form>
        </div>
    </div>
</body>
</html>