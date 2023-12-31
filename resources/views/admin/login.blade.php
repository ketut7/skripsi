<x-admin-layout>
    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">

            <form class="col-md-9 m-auto" method="post" role="form" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="inputemail">Username</label>
                    <input type="text" class="form-control mt-1 @error('username') is-invalid @enderror"  name="username" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputname">Password</label>
                    <input type="password" class="form-control mt-1 @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->

</x-admin-layout>
