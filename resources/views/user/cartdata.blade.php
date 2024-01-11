<table class="table table" id="data" class="text-center">
    <tr>
        <th>No</th>
        <th>Nama Buku</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    @php
        $total = 0;
    @endphp
    @foreach ($cart as $key => $val)
        <tr>
            <td>{{$key + 1}}</td>
            @if ($val->buku != null && $val->buku->judul_buku != null)
                <td>{{$val->buku->judul_buku}}</td>
            @elseif ($val->NonBuku != null)
                <td>{{$val->NonBuku->nama}}</td>
            @else
                <td>N/A</td>
            @endif
            <td>{{$val->qty}}</td>
            <td>Rp. {{number_format($val->subtotal,2)}}</td>
            <td><button class="btn btn-outline-danger delete-btn" data-id="{{$val->id}}" id="del">Delete</button></td>
        </tr>
        @php
            $total += $val->subtotal;
        @endphp
    @endforeach
</table>
<p id="totalAmount">Total semuanya adalah : Rp. {{number_format($total,2)}}</p>
<script>
    $(document).ready(function(){
        $(".delete-btn").click(function(){
            var id = $(this).data("id");
            var row = $(this).closest('tr');
            $.ajax({
                url: '/deleteFromCart',
                method: 'GET',
                data: {id: id, _token: '{{ csrf_token() }}'},
                success: function (response) {
                    if (response.success) {
                        alert(response.success);
                        row.remove();
                        updateTotal();
                    } else {
                        alert(response.error || 'Failed to disable user');
                    }
                },
                error: function (xhr, status, error) {
                    alert('Ajax request failed: ' + status + ', ' + error);
                }
            });
        });

        function updateTotal() {
            var total = 0;
            $("table tbody tr").each(function () {
                var subtotal = parseFloat($(this).find("td:eq(3)").text().replace("Rp. ", "").replace(",", ""));
                total += isNaN(subtotal) ? 0 : subtotal;
            });
            $("p#totalAmount").text("Total semuanya adalah : Rp. " + total.toFixed(2));
        }
    });
</script>
