<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a class="nav-link" href="#" style="color:navy;">Welcome, {{$username}}</a>
@isset($user)
    @if ($user->status == "-")
        <h4>Cek ulang data anda</h4>
        <p>Nama : {{$user->nama}}</p>
        <p>Email : {{$user->email}}</p>
        <p>Username : {{$user->username}}</p>
        <p>Tanggal Lahir : {{$user->tgl_lahir}}</p>
        <button onclick="window.location.href='{{route('kirim-lamaran',['id_user' => $user->id_user])}}'">Kirim Lamaran</button>
    @elseif ($user->lamaran->status == "pending")
        <h4>Tunggu sampai lamaran diterima</h4>
    @elseif ($user->lamaran->status == "Rejected")
        <h4>Anda ditolak, gudlak untuk berikutnya</h4>
    @elseif ($user->lamaran->status == "Accepted")
        <h4>Anda diterima, selamat</h4>
    @endif
@else
    <p>User not found</p>
@endisset
@if(Session::has('success'))
    <p style="color: green;">{{ Session::get('success') }}</p>
@endif
</body>
</html>