<x-guest-layout>
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
        <!-- Social login form-->
        <div class="card my-5">
            <div class="card-body p-5 text-center">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="h3 fw-light mb-3">Password Recovery</div>
            </div>
            <hr class="my-0" />
            <div class="card-body p-5">
                <div class="text-center small text-muted mb-4">Enter your email address below and we will send you a
                    link to reset your password.</div>
                <!-- Forgot password form-->
                <form method="POST" action={{ route('password.email') }}>
                    @csrf
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="text-gray-600 small" for="emailExample">Email address</label>
                        <input class="form-control @error('email') is-invalid @enderror form-control-solid"
                            name="email" id="email" type="text" placeholder="" value="{{ old('email') }}"
                            aria-label="Email Address" aria-describedby="emailExample">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Form Group (reset password button)    -->
                    <button class="btn
                            btn-primary">Reset Password</button>
                </form>
            </div>
            <hr class="my-0" />
            <div class="card-body px-5 py-4">
                <div class="small text-center">
                    New user?
                    <a href={{ route('register') }}>Create an account!</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
