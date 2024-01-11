@if(isset($nonbuku))
    <div class="row">
        @foreach($nonbuku as $book)
            <div class="col-md-2">
                <div class="card" style="margin-bottom: 20px; border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                    <img src="{{ $book->gambar }}" class="card-img-top" alt="{{ $book->nama }}" width="" height="250px">
                    <div class="card-body">
                        <p class="card-text">{{ $book->users->nama }}</p>
                        <h5 class="card-title">{{ $book->nama }}</h5>
                        <p class="card-text text-primary">Rp. {{ $book->harga }}</p>
                        <a href="{{route('detail-NonBuku',['id_alat_tulis' => $book->id_alat_tulis])}}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif