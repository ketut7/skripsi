<x-admin-layout>
    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-9 m-auto">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted font-weight-medium">Jumlah Produk</p>
                                        <h4 class="mb-0">{{ $summary['total_produk'] }}</h4>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="mdi mdi-timer-sand font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted font-weight-medium">Jumlah Transaksi Hari Ini</p>
                                        <h4 class="mb-0">{{ $summary['jumlah_transaksi'] }}</h4>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="mdi mdi-timer-sand font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted font-weight-medium">Total Transaksi Hari Ini</p>
                                        <h4 class="mb-0">{{ $summary['total_transaksi'] }}</h4>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="mdi mdi-timer-sand font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 5 Transaksi Terakhir --}}
                <div class="row">
                    <!-- col end -->
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="h2">Daftar Transaksi Terakhir</h1>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Status</th>
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
                                            <td>Rp. {{ number_format($item->total_harga) }}</td>
                                            <td>
                                                <a href="{{ route('admin.transaksi.show', [$item->id]) }}" class="btn btn-danger btn-sm">Detail</a>
                                            </td>
                                            @endforeach
                                            <!-- Add more rows for additional products -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 5 Produk Terakhir --}}
                <div class="row">

                    <!-- col end -->
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="h2">Daftar Produk</h1>
                                <a href="{{ route('admin.produk.create') }}" class="btn btn-success btn-sm">Tambah</a>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Produk</th>
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
                                            <td>Rp. {{ number_format($item->harga) }}</td>
                                            <td>
                                                <a href="{{ route('admin.produk.edit', [$item->id]) }}" class="btn btn-danger btn-sm">Edit</a>
                                                <a href="javascript: return false;" class="btn btn-danger btn-sm" onclick="confirmDelete({{$item->id}})">Remove</a>
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
        </div>
    </div>
    <!-- End Contact -->

</x-admin-layout>
