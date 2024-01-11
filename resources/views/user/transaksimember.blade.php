<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="/jquery.min.js"></script>
    <script src="/jquery.form.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong bg-body-tertiary" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                @if(Session::has('err'))
                    <p style="color: red;">{{ Session::get('err') }}</p>
                @endif
                <h1 width="40" size="20"> Isi Saldo </h1>
                <p>Nama : {{$user->nama}}</p>
                <p>Saldo : Rp. {{$user->saldo}},00</p>
                <p>Harga Member Adalah Rp. 300.000, harap diperhatikan saldo anda</p>
                <form action="{{route('beli-member')}}" method="post">
                    @csrf 
                    <div class="form-outline mb-4">
                        <p>Id User : </p>
                        <input type="text" name="id" id="id" class="form-control form-control-lg" value="{{$user->id_user}}" readonly>
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
                <br>
                <a href="{{route('user-detail')}}">Kembali</a>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>