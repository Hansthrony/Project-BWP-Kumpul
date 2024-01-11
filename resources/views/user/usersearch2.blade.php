@extends('layout/userlayout')

@section('title', 'User')

@section('navbar')

@endsection

@section('daftar')
<h1>Cari Buku</h1>
<div style="display: inline; margin-bottom: 15px;">
    <button class="btn btn-outline-primary" onclick="window.location.href='{{route('user-search')}}'">Buku</button>
    <button class="btn btn-outline-primary" onclick="window.location.href='{{route('user-search-2')}}'">Non Buku</button>
</div>
<div class="form-outline mb-4">
    <input type="text" name="search" id="search" placeholder="Search something..."> <button type="submit" name="cari" id="cari" class="btn btn-outline-primary">Cari</button>
</div>
<hr>
<div id="data">
    @include('user/searchresult2');
</div>
<script>
    $(document).ready(function () {
        $("#cari").click(function () {
            var search = $("#search").val();
            if(search != "")
            {
                $.ajax({
                    url: '/searchNonBuku',
                    method: 'POST',
                    data: {search: search, _token: '{{ csrf_token() }}'},
                    success: function (response) {
                        if (response.html) {
                            $("#data").html(response.html);
                        } else {
                            alert(response.error || 'Error while processing');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Ajax request failed: ' + status + ', ' + error);
                    }
                });
            }
        });
    });
</script>
@endsection