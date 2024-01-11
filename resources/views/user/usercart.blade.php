@extends('layout/userlayout')

@section('title', 'User')

@section('navbar')

@endsection

@section('daftar')
<h1>Lihat isi cart</h1>
<div id="data">
    @include('user/cartdata')
    <button class="btn btn-outline-success" onclick="window.location.href='{{route('user-checkout')}}'">Checkout</button>
</div>
@endsection