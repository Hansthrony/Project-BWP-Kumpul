@extends('layout/logregLayout')

@section('title', 'Register')

@section('navbar')

@endsection

@section('isi')
    <div style="background-color: white;box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.5);border-radius:20px;">
        @if(Session::has('err'))
                <p style="color: red;">{{ Session::get('err') }}</p>
        @endif
        <form action="{{ route('do-register')}}" method="post">
            @csrf
            <h2 style="text-align:center;margin-top:10px;">Register</h2>
            <hr>
            Email : 
            <input type="text" name="txtEmail" id="txtEmail" class="form-control"><br>
            Nama : 
            <input type="text" name="txtNama" id="txtNama" class="form-control"><br>
            Username : 
            <input type="text" name="txtUsername" id="txtUsername" class="form-control"><br>
            Password : 
            <input type="password" name="txtPass" id="txtPass" class="form-control"><br>
            Confirm Password : 
            <input type="password" name="txtCpass" id="txtCpass" class="form-control"><br>
            Tanggal Lahir : 
            <input type="date" name="txtDate" id="txtDate" class="form-control"><br>
            Role : 
            <select name="cbRole" id="cbRole" class="form-control">
                @foreach($dataroles as $key => $role)
                    @if($key < 2)
                        <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                    @endif
                @endforeach
            </select><br>
            <div class="d-grid gap-2">
                <input type="submit" value="Register" class="btn btn-primary"><br>
            </div>
        </form>
        <p class="text-center"><a href="{{ route('login')}}">Login sini</a></p>
    </div>
@endsection