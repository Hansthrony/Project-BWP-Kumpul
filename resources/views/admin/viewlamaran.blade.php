<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
    <h1 class="">Detail lamaran</h1>
    <button class="btn btn-success" onclick="window.location.href='{{route('admin-user')}}'">Kembali</button>
    <hr>
    <div class="text-center">
        @if (isset($data))
        @php
            $birthdate = new DateTime($data->users->tgl_lahir);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthdate)->y;
            $date = date('d/m/Y',strtotime($data->users->tgl_lahir));
        @endphp
            <p>Email Pelamar : {{$data->users->email}}</p>
            <p>Nama Pelamar : {{$data->users->nama}}</p>
            <p>Tanggal Lahir Pelamar : {{$date}}</p>
            <p>Usia Pelamar : {{$age}}</p>
            <div style="display: inline-block;">
                <form action="{{route('accept-or-reject')}}" method="post">
                    @csrf 
                    <input type="text" name="alasan" id="" placeholder="Alasan ditolak?"> <br> <br>
                    <button class="btn btn-outline-success" style="float: left;" name="action" value="accept-{{$data->id_lamaran}}">Terima</button>
                    <button class="btn btn-outline-danger" style="float: right;" name="action" value="reject-{{$data->id_lamaran}}">Tolak</button>
                </form>
            </div>
            @if(Session::has('err'))
                <p style="color: red;">{{ Session::get('err') }}</p>
            @endif
        @endif
    </div>
</body>
</html>