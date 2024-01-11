<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
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
        }

        .row {
            border: 1px solid black;
            width: 80%;
            height: 220px;
            margin-top: 5%;
        }

        .pic {
            width: 40%;
            background-color: lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .picture {
            max-width: 100%;
            max-height: 100%;
        }

        .detail {
            flex: 1;
            padding: 10px;
        }

        .detail1,
        .detail2 {
            display: inline-block;
            width: 48%;
        }

        .detail1 {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Detail Buku</h1>
    <a href="{{route('user-home')}}">Kembali</a>
    <hr>
    @if(Session::has('err'))
        <p style="color: red;">{{ Session::get('err') }}</p>
    @elseif(Session::has('success'))
        <p style="color: green;">{{ Session::get('success') }}</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="pic">
                <img class="card-img-top" src="{{ asset('Image/' . $nonbuku->gambar) }}" style="height: 150px; width:150px;"
                            alt="Card image cap">
            </div>
            <div class="detail">
                <p>Nama : {{$nonbuku->nama}}</p>
                {{-- <p>Pembuat : {{$nonbuku->users->nama}}</p> --}}
                @if($user->users_id_role == 3)
                    <p>Harga : Rp.{{$nonbuku->harga}},00</p>
                @else
                    <p>Harga : <span style="text-decoration: line-through; color: red;">Rp.{{$nonbuku->harga}},00</span></p>
                    <p>Harga : Rp.{{$nonbuku->harga-(($nonbuku->harga*20)/100)}},00</p>
                @endif
                <form action="{{route('add-to-cart-nonbuku')}}" method="post">
                    @csrf
                    <input type="hidden" name="idalattulis" value="{{$nonbuku->id_alat_tulis}}">
                    <input type="hidden" name="iduser" value="{{$user->id_user}}">
                    <input type="submit" value="Add To Cart" name="add" class="btn btn-outline-primary">
                </form>
            </div>
        </div>
    </div>
</body>
<script>

</script>
</html>
