@extends('layout/adminLayout')

@section('title', 'Admin')

@section('navbar')

@endsection

@section('daftar')
<h1>Lihat hasil transaksi</h1>
<hr>
<table class="table-bordered">
    <tr>
        <th>No</th>
        <th>Nama user</th>
        <th>Metode</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
        <th>Alamat pengiriman</th>
    </tr>
    @foreach ($trans as $key => $res)
        @if ($res->users->users_id_role == 4)
            <tr class="bg-success">
        @else
            <tr class="bg-warning">
        @endif
            <td>{{$key + 1}}</td>
            <td>{{$res->users->nama}}</td>
            <td>{{$res->metode}}</td>
            <td>{{$res->qty}}</td>
            <td>{{$res->subtotal}}</td>
            <td>{{$res->tgl_beli}}</td>
            <td>{{$res->alamat}}</td>
        </tr>
    @endforeach
</table>
@endsection
