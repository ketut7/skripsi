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

                            <h1 class="h2">Transaksi List</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No Transaksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status Pengiriman</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transaksi as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->status_pengiriman ?? '-' }}</td>
                                    <td>Rp. {{ number_format($item->total_harga) }}</td>
                                    <td>
                                        <a href="{{ route('transaksi.show', [$item->id]) }}" class="btn btn-info">
                                            Detail
                                        </a>
                                    </td>
                                @endforeach
                                <!-- Add more rows for additional products -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
</x-layout>
