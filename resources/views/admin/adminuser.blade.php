@extends('layout/adminLayout')

@section('title', 'Admin')

@section('navbar')

@endsection

@section('daftar')
<h1 style="margin-top: 3%;">Lihat User</h1>
<hr>
<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchUser" id="searchUser">
<hr>
<div id="data">
    @include('admin/datatable')
</div>
@endsection