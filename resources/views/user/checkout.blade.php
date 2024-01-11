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

        .row {
            border: 1px solid black;
            width: 80%;
            height: 330px;
        }

        .second-row {
            border: 1px solid black;
            width: 68%;
            height: 270px;
            margin-top: 5%;
            margin-left: 16%;
            overflow-y: auto;
            justify-content: center;
            align-items: center;
        }

        .data {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .datares {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Bayar Barang</h1>
    <a href="{{route('user-cart')}}">Kembali</a>
    @if(Session::has('err'))
            <p style="color: red;">{{ Session::get('err') }}</p>
    @endif
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6 data" style="overflow-y: auto;">
                <div id="data" class="datares">
                    <table class="table-bordered" id="data" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                        @php
                            $total = 0;
                            $finaltotal = 0;
                            $count = 0;
                        @endphp
                        @foreach ($cart as $key => $val)
                            <tr>
                                <td>{{$key + 1}}</td>
                                @if ($val->buku != null && $val->buku->judul_buku != null)
                                    <td>{{$val->buku->judul_buku}}</td>
                                @elseif ($val->NonBuku != null)
                                    <td>{{$val->NonBuku->nama}}</td>
                                @else
                                    <td>N/A</td>
                                @endif
                                <td>{{$val->qty}}</td>
                                <td>Rp. {{number_format($val->subtotal,2)}}</td>
                            </tr>
                            @php
                                $total += $val->subtotal;
                                $finaltotal += $total;
                                $count += $val->qty;
                            @endphp
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-6 text-white" style="background-color: rgb(70, 67, 110);">
                <h4>Spesifikasi Pembayaran</h4>
                <p>Catatan : Ongkir Gratis</p>
                <p>Total semuanya adalah : Rp. {{number_format($total,2)}}</p>
                <p>Pajak : 10%</p>
                <p>Free delivery</p>
                @if ($user->users_id_role == 3)
                    <p style="color: red;">Diskon : -</p>
                    <p style="color: red;">Diskon Biaya = -</p>
                    @php
                        $finaltotal = $total;
                    @endphp
                @elseif($user->users_id_role == 3 && $total > 300000)
                    <p style="color: red;">Diskon Member : -</p>
                    <p style="color: red;">Diskon Biaya : 10%</p>
                    @php
                        $finaltotal = $total - (($total*10)/100);
                    @endphp
                @elseif($user->users_id_role == 4)
                    <p style="color: red;">Diskon Member : 20%</p>
                    <p style="color: red;">Diskon Biaya = -</p>
                    @php
                        $finaltotal = $total;
                    @endphp
                @elseif($user->users_id_role == 4 && $total > 300000)
                    <p style="color: red;">Diskon Member : 20%</p>
                    <p style="color: red;">Diskon Biaya : 20%</p>
                    @php
                        $finaltotal = $total - (($total*20)/100);
                    @endphp
                @endif
                <p style="color: rgb(0, 130, 139);">Biaya akhir : Rp. {{number_format($finaltotal,2)}}</p>
            </div>
        </div>
    </div>    
    <div class="col-md-6 second-row">
        <form action="{{route('checkout')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$user->id_user}}">
            <input type="hidden" name="biaya" value="{{$finaltotal}}">
            <input type="hidden" name="count" value="{{$count}}">
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
                <p>Alamat Pengiriman : </p>
                <input type="text" name="alamat" id="alamat" class="form-control form-control-lg">
            </div>
            <input type="submit" value="Bayar" name="bayar" class="btn btn-outline-primary">
        </form>
    </div>
</body>
</html>