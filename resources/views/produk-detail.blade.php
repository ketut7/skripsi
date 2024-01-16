<x-layout>
    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ $produk->gambar_url }}" alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{ $produk->nama }}</h1>
                            <p class="h3 py-2">Rp.{{ number_format($produk->harga) }}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Berat:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{ $produk->berat }} kg</strong></p>
                                </li>
                            </ul>

                            <h6>Deskripsi:</h6>
                            <p>{{ $produk->deskripsi }}</p>
                            @if($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                            @endif
                            @if(auth()->user())
                                <form method="POST" action="{{ route('tambah_keranjang') }}">
                                    @csrf
                                    <input type="hidden" name="product-title" value="Activewear">
                                    <div class="row">
                                        <div class="col-auto">
                                            <ul class="list-inline pb-3">
                                                <li class="list-inline-item text-right">
                                                    Quantity
                                                    <input type="hidden" name="jumlah" id="product-quantity" value="1">
                                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                                </li>
                                                <li class="list-inline-item"><span class="btn btn-success" id="btn-minus" onclick="updateQuantityValue('minus')">-</span></li>
                                                <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                                <li class="list-inline-item"><span class="btn btn-success" id="btn-plus" onclick="updateQuantityValue('plus')">+</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col d-grid">
                                            <button type="submit" class="btn btn-success btn-lg" name="submit" value="bayar">Buy</button>
                                        </div>
                                        <div class="col d-grid">
                                            <button type="submit" class="btn btn-success btn-lg" name="submit" value="tambah-keranjang">Add To Cart</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-info">
                                    <ul>
                                        <li>Silahkan <a href="{{ route('login') }}">Login</a> untuk melakukan transaksi</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->


    <script>
        function updateQuantityValue(action) {
            let value = parseInt(document.getElementById('var-value').innerText);

            if (action == 'plus') {
                value = isNaN(value) ? 0 : value;
                value++;
            } else if (action == 'minus') {
                value = isNaN(value) ? 0 : value;
                value < 1 ? value = 1 : '';
                value--;
            }

            document.getElementById('var-value').innerText = value;
            document.getElementById('product-quantity').value = value;
        }
    </script>

</x-layout>
