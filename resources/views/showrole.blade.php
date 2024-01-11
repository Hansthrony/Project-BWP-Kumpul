<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <table class="table table-striped">
            @foreach($dataroles as $item)
                <tr>
                    <td>{{ $item->id_role }}</td>
                    <td>{{ $item->nama_role }}</td>
                </tr>
            @endforeach
        </table>
        <div>
            <form action="{{ url('simpanrole') }}" method="post">
                @csrf
                Nama Role : 
                <input type="text" name="txtName"><br><br>
                <input type="submit" name="btnSubmit" value="Tambah Role">
            </form>
        </div>
    </div>
</body>
</html>

