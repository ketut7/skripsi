<x-layout>
    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" method="post" role="form" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Nama</label>
                        <input type="text" class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama" placeholder="Nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail">Email</label>
                        <input type="email" class="form-control mt-1 @error('email') is-invalid @enderror"  name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputsubject">Nomor Telepon</label>
                    <input type="text" class="form-control mt-1 @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}">
                    @error('nomor_telepon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputmessage">Alamat</label>
                    <textarea class="form-control mt-1 @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" rows="2">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Password</label>
                        <input type="password" class="form-control mt-1 @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail">Konfirmasi Password</label>
                        <input type="password" class="form-control mt-1 @error('confirmation_password') is-invalid @enderror"  name="password_confirmation" placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}">
                        @error('confirmation_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg px-3">Login</a>
                        <button type="submit" class="btn btn-success btn-lg px-3">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->

</x-layout>
