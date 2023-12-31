<x-layout>
    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">

                <!-- col end -->
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            <h1 class="h2">Shopping Cart</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keranjang as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>Rp. {{ number_format($item->harga) }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp. {{ number_format($item->total_harga) }}</td>
                                    <td>
                                        <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                @endforeach
                                <!-- Add more rows for additional products -->
                                </tbody>
                            </table>
                            <div class="text-right">
                                <h4>Total: Rp. {{ number_format($totalHarga) }}</h4>
                            </div>
                            <div class="text-right mt-3">
                                <form method="POST" action="{{ route('checkout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
</x-layout>
