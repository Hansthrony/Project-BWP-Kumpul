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
                <h1 width="40" size="20"> Edit User </h1>
                <p>Reminder: Email tidak dapat diganti</p>
                <p>Email : {{$user->email}}</p>
                <form action="{{route('edit-user')}}" method="post">
                    @csrf 
                    <div class="form-outline mb-4">
                        <p>Id User : </p>
                        <input type="text" name="id" id="id" class="form-control form-control-lg" value="{{$user->id_user}}" readonly>
                    </div>
                    <div class="form-outline mb-4">
                        <p>Nama : </p>
                        <input type="text" name="nama" id="nama" class="form-control form-control-lg" value="{{$user->nama}}">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Username : </p>
                        <input type="text" name="user" id="user" class="form-control form-control-lg" value="{{$user->username}}">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Password Lama: </p>
                        <input type="text" name="pass" id="pass" class="form-control form-control-lg">
                    </div>
                    <div class="form-outline mb-4">
                        <p>Password Baru: </p>
                        <input type="text" name="npass" id="npass" class="form-control form-control-lg">
                    </div>
                    <input type="submit" value="Save Data" name="save" class="btn btn-outline-primary">
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