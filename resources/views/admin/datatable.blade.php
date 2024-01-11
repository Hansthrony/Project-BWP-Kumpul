<table class="table table" id="data">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Tanggal Lahir</th>
        <th>Password</th>
        <th>Saldo</th>
        <th>Role</th>
        <th>Status</th>
    </tr>
@foreach($data as $key => $res)
    @if ($res->status == "active")
    <tr class="bg-success">
        <td>{{$key + 1}}</td>
        <td>{{$res->nama}}</td>
        <td>{{$res->email}}</td>
        <td>{{$res->tgl_lahir}}</td>
        <td>{{$res->password}}</td>
        <td>{{$res->saldo}}</td>
        <td>{{$res->roles->nama_role}}</td>
        <td><button class="btn btn-danger toggle-btn" value="{{$res->id_user}}">Disable</button></td>
    </tr>
    @else
    <tr class="bg-danger">
        <td>{{$key + 1}}</td>
        <td>{{$res->nama}}</td>
        <td>{{$res->email}}</td>
        <td>{{$res->tgl_lahir}}</td>
        <td>{{$res->password}}</td>
        <td>{{$res->saldo}}</td>
        <td>{{$res->roles->nama_role}}</td>
        <td><button class="btn btn-success toggle-btn" value="{{$res->id_user}}">Activate</button></td>
    </tr>
    @endif
@endforeach
</table>
<script>
    $(document).ready(function () {
        $('.toggle-btn').click(function(){
            var id = $(this).val();
            $.ajax({
                url: "/toggleUser",
                method: 'POST',
                data: {id_user: id, _token: '{{ csrf_token() }}'},
                success: function (response) {
                    if (response.success) {
                        alert(response.success);
                        $("#data").html(response.html);
                    } else {
                        alert(response.error || 'Failed to disable user');
                    }
                },
                error: function (xhr, status, error) {
                    alert('Ajax request failed: ' + status + ', ' + error);
                }
            });
        });
    });
</script>
