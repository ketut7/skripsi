<x-admin-layout>
    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">

            <div class="col-9 m-auto mb-3">
                <h1>{{ request()->route()->getActionMethod() == 'edit' ? 'Edit' : 'Tambah' }} Produk</h1>
            </div>
            <form class="col-md-9 m-auto" method="post" role="form" action="{{ request()->route()->getActionMethod() == 'edit' ? route('admin.produk.update', [optional($produk)->id]) : route('admin.produk.store') }}" enctype="multipart/form-data">
                @csrf
                @if (request()->route()->getActionMethod() == 'edit')
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="inputname">Nama</label>
                    <input type="text" class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama" placeholder="Nama" value="{{ old('nama', optional($produk)->nama) }}">
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputmessage">Deskripsi</label>
                    <textarea class="form-control mt-1 @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Deskripsi" rows="8">{{ old('deskripsi', optional($produk)->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputname">Berat</label>
                    <input type="text" class="form-control mt-1 @error('berat') is-invalid @enderror" name="berat" placeholder="Berat" value="{{ old('berat', optional($produk)->berat) }}">
                    @error('berat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputname">Harga</label>
                    <input type="number" class="form-control mt-1 @error('harga') is-invalid @enderror" name="harga" placeholder="Harga" value="{{ old('harga', (int) optional($produk)->harga) }}">
                    @error('harga')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputmessage">Upload Gambar</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror"></input>
                    @error('gambar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3">{{ request()->route()->getActionMethod() == 'edit' ? 'Edit' : 'Tambah' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->

</x-admin-layout>
