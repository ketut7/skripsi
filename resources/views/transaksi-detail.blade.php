<x-layout>


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
                </table>
                @if($transaksi->status == 'pending')
                    <p>
                        Untuk pembayaran silahkan transfer ke rekening berikut:<br>
                        <strong>Bank BCA: 123123123123</strong><br>
                        <strong>Bank BRI: 123123123123</strong><br>
                    </p>
                    <p>Jika anda sudah melakukan pembayaran, silahkan konfirmasi pembayaran anda dengan mengisi form dibawah ini.</p>

                    <form class="col-md-9 m-auto" method="post" role="form" action="{{ route('konfirmasi.pembayaran', [$transaksi->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="inputsubject">Transfer ke</label>
                            <select class="form-control" name="metode_pembayaran" >
                                <option value="">Pilih metode pembayaran</option>
                                <option value="bca">BCA</option>
                                <option value="bri">BRI</option>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="inputmessage">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control"></input>
                        </div>
                        <div class="row">
                            <div class="col text-end mt-2">
                                <button type="submit" class="btn btn-success btn-lg px-3">Konfirmasi Pembayaran</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

    </section>
    <!-- End Section -->

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our Brands</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->

</x-layout>
