<x-admin-layout>
    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-8 m-auto">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                <h1 class="h1">Detail Transaksi</h1>
                <table class="text-start table mt-4">
                    <tr>
                        <td style="width: 40%">No. Transaksi</td>
                        <td>:</td>
                        <td style="width: 58%">{{ $transaksi->no_transaksi }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Transaksi</td>
                        <td>:</td>
                        <td>{{ $transaksi->created_at->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Status Transaksi</td>
                        <td>:</td>
                        <td>{{ $transaksi->status }}</td>
                    </tr>
                    <tr>
                        <td>Status Pengiriman</td>
                        <td>:</td>
                        <td>{{ $transaksi->status_pengiriman ?? 'Belum di proses' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $transaksi->alamat }}</td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>:</td>
                        <td>{{ $transaksi->nomor_telepon }}</td>
                    </tr>
                    <tr>
                        <td>No Resi</td>
                        <td>:</td>
                        <td>{{ $transaksi->no_resi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Total Item + Ongkir</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($transaksi->total_item) }} + Rp. {{ number_format($transaksi->ongkir) }}</td>
                    </tr>
                    <tr>
                        <td>Total Pembayaran</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($transaksi->total_harga) }}</td>
                    </tr>
                    <tr>
                        <td>Bukti Pembayaran</td>
                        <td>:</td>
                        <td>
                            @if($transaksi->bukti_pembayaran)
                                <img
                                    src="{{ asset('bukti_pembayaran/' . $transaksi->bukti_pembayaran) }}"
                                    alt=""
                                    width="300"
                                    onclick="window.open(
                                      '{{ asset('bukti_pembayaran/' . $transaksi->bukti_pembayaran) }}',
                                      '_blank' // <- This is what makes it open in a new window.
                                    )">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
                <form class="col-md-9 m-auto" method="post" role="form" action="{{ route('admin.transaksi.update', [$transaksi->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 text-start">
                        <label for="inputsubject">Status Transaksi</label>
                        <select class="form-control" name="status" >
                            <option value="">Pilih transaksi status</option>
                            <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="menunggu verifikasi" {{ $transaksi->status == 'menunggu verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="terbayar" {{ $transaksi->status == 'terbayar' ? 'selected' : '' }}>Terbayar</option>
                            <option value="menunggu pengiriman" {{ $transaksi->status == 'menunggu pengiriman' ? 'selected' : '' }}>Menunggu Pengiriman</option>
                            <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ $transaksi->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="inputsubject">Status Pengiriman</label>
                        <select class="form-control" name="status_pengiriman" >
                            <option value="">Belum di proses</option>
                            <option value="sedang di proses" {{ $transaksi->status_pengiriman == 'sedang di proses' ? 'selected' : '' }}>Sedang di Proses</option>
                            <option value="dikirim" {{ $transaksi->status_pengiriman == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="antar ulang" {{ $transaksi->status_pengiriman == 'antar ulang' ? 'selected' : '' }}>Antar Ulang</option>
                            <option value="transit" {{ $transaksi->status_pengiriman == 'transit' ? 'selected' : '' }}>Transit</option>
                            <option value="terkirim" {{ $transaksi->status_pengiriman == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                        </select>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="inputsubject">No Resi</label>
                        <input type="text" class="form-control" name="no_resi" value="{{ $transaksi->no_resi }}">
                    </div>
                    <div class="row">
                        <div class="col text-end mt-2">
                            <button type="submit" class="btn btn-success btn-lg px-3">Ubah Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Section -->
</x-admin-layout>
