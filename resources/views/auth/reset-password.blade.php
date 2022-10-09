<x-guest-layout>
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
        <!-- Social login form-->
        <div class="card my-5">
            <div class="card-body p-5 text-center">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="h3 fw-light mb-3">Update Password</div>
            </div>
            <div class="card-body p-5">

                <!-- Forgot password form-->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="text-gray-600 small" for="emailExample">Email address</label>
                        <input type="hidden" name="email" value={{ old('email', $request->email) }}>
                        <input disabled class="form-control @error('email') is-invalid @enderror form-control-solid"
                            id="email" type="text" placeholder="" value={{ old('email', $request->email) }}
                            aria-label="Email Address" aria-describedby="emailExample">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="text-gray-600 small" for="passwordExample">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror form-control-solid"
                            name="password" type="password" placeholder="" aria-label="Password"
                            aria-describedby="passwordExample" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <!-- Form Group (confirm password)-->
                        <div class="mb-3">
                            <label class="text-gray-600 small" for="confirmPasswordExample">Confirm Password</label>
                            <input class="form-control @error('password_confirmation') @enderror form-control-solid"
                                name="password_confirmation" type="password" placeholder=""
                                aria-label="Confirm Password" aria-describedby="confirmPasswordExample" />
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Form Group (reset password button)    -->
                    <button class="btn btn-primary">Update Password</button>
                </form>
            </div>
            <hr class="my-0" />
            <div class="card-body px-5 py-4">
                <div class="small text-center">
                    Jika ingat silahkan ?
                    <a href={{ route('login') }}>Login!</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
