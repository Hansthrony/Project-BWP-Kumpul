@extends('layout/logregLayout')

@section('title', 'Login')

@section('navbar')

@endsection

@section('isi')
<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <h1 width="40" size="20"> Toko Buku Moyai</h1>
            <p>Login</p>
            <form action="{{ route('change-pass') }}" method="post">
                @csrf
                <div class="form-outline mb-4">
                    <p>Email : </p>
                    <input type="text" name="txtEmail" id="txtEmail" class="form-control form-control-lg" value="{{ $enteredEmail }}" readonly>
                </div>
                <div class="form-outline mb-4">
                    <p>New Password : </p>
                    <input type="text" name="txtPass" id="txtPass" class="form-control form-control-lg">
                </div>
                <input type="submit" value="Change" name="btnChange" class="btn btn-primary btn-lg btn-block">
            </form>
            <br>
            <p><a href="{{ route('login')}}">Back</a></p>     
          </div>
        </div>
      </div>
    </div>
</div>
@endsection