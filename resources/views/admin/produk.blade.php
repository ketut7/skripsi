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

                            <h1 class="h2">Daftar Produk</h1>
                            <a href="{{ route('admin.produk.create') }}" class="btn btn-success btn-sm">Tambah</a>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produk as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <img src="{{ asset('produk/' . $item->gambar) }}" alt="" width="150" height="150">
                                        {{ $item->nama }}
                                    </td>
                                    <td>{{ $item->berat }}</td>
                                    <td>Rp. {{ number_format($item->harga) }}</td>
                                    <td>
                                        <a href="{{ route('admin.produk.edit', [$item->id]) }}" class="btn btn-danger btn-sm">Edit</a>
                                        <a href="javascript: return false;" class="btn btn-danger btn-sm" onclick="confirmDelete({{$item->id}})">Remove</a>
                                    </td>
                                @endforeach
                                <!-- Add more rows for additional products -->
                                </tbody>
                            </table>

                            {{ $produk->links('vendor.pagination.default') }}
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
