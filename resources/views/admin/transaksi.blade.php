<x-admin-layout>
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

                            <h1 class="h2">Daftar Transaksi</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Customer</th>
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
                                    <td>
                                        {{ $item->user->nama }}
                                    </td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->status_pengiriman }}</td>
                                    <td>Rp. {{ number_format($item->total_harga) }}</td>
                                    <td>
                                        <a href="{{ route('admin.transaksi.show', [$item->id]) }}" class="btn btn-danger btn-sm">Detail</a>
                                    </td>
                                @endforeach
                                <!-- Add more rows for additional products -->
                                </tbody>
                            </table>

                            {{ $transaksi->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="#" method="POST" id="delete-form">
            @csrf
            @method('DELETE')
        </form>
    </section>
    <!-- Close Content -->

    <script >
        function confirmDelete(id) {
            if (confirm("Are you sure want to delete this produk?") == true) {
                document.getElementById('delete-form').action = window.location.href + '/' + id;
                document.getElementById('delete-form').submit();
            } else {
                return false;
            }
        }
    </script>
</x-admin-layout>
