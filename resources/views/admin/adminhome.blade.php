@extends('layout/adminLayout')

@section('title', 'Admin')

@section('navbar')

@endsection

@section('daftar')
<h1>Lihat permohonan</h1>
<table border="1" class="table table">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Action</th>
    </tr>
    @foreach ($lamaran as $key => $res)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$res->users->nama}}</td>
            <td><button onclick="window.location.href='{{route('detail-lamaran',['id_lamaran' => $res->id_lamaran])}}'">Details</button></td>
        </tr>
    @endforeach
</table>
@endsection
