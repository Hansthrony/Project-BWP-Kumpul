@extends('layout/userlayout')

@section('title', 'User')

@section('navbar')

@endsection

@section('daftar')
<div class="container py-5" id="data">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            @if(Session::has('err'))
                <p style="color: red;">{{ Session::get('err') }}</p>
            @endif
            <h1 width="40" size="20"> Data Diri</h1>
            <p>Nama : {{$user->nama}}</p>
            <p>Email : {{$user->email}}</p>
            <p>Tanggal Lahir : {{$user->tgl_lahir}}</p>
            <p style="margin-bottom: 5px;">Saldo : Rp. {{$user->saldo}},00</p>
            @if ($user->roles->id_role == 4)
                Member :<p style="color: green; display: inline; margin-top: -2%; margin-bottom: 1%;"> Iya</p>
            @else
                Member :<p style="color: red; display: inline; margin-top: -2%; margin-bottom: 1%;"> Tidak</p>
            @endif
            <br>
            <button onclick="window.location.href='{{route('isisaldo-page',['id_user' => $user->id_user])}}'" class="btn btn-outline-warning" style="margin-top: 2%;">Isi saldo</button>
            <button onclick="window.location.href='{{route('edituser-page',['id_user' => $user->id_user])}}'" class="btn btn-outline-primary" style="margin-top: 2%;">Edit data</button>
            @if ($user->roles->id_role == 3)
                <br> <br>
                <button onclick="window.location.href='{{route('transaksi-page',['id_user' => $user->id_user])}}'" class="btn btn-outline-success" id="beli" style="margin-top: -2%;">Beli Member</button>
            @else
                <br> <br>
                <button value="{{$user->id_user}}" class="btn btn-outline-danger" id="batal" style="margin-top: -2%;">Batalkan Member</button>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#batal").click(function(){
            var confirmation = confirm("Ingin membatalkan member?");
            var id = $(this).val();
            if(confirmation)
            {
                $.ajax({
                    url: '/batalMember',
                    method: 'POST',
                    data: {id_user: id, _token: '{{ csrf_token() }}'},
                    success: function (response) {
                        if (response.success) {
                            alert(response.success);
                            updateMemberStatus(false);
                        } else {
                            alert(response.error || 'Ada error');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Ajax request failed: ' + status + ', ' + error);
                    }
                });
            }
            else 
            {
                alert('Oke :v');
            }
        });

        function updateMemberStatus(isMember) {
            var memberText = isMember ? "Member :<p style='color: green; display: inline; margin-top: -2%; margin-bottom: 1%;'> Iya</p>" : "Member :<p style='color: red; display: inline; margin-top: -2%; margin-bottom: 1%;'> Tidak</p>";
            $("#data p:contains('Member')").html(memberText);
        }
    });
</script>
@endsection