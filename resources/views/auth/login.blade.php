<x-guest-layout>
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
        <!-- Social login form-->
        <div class="card my-5">
            <div class="card-body p-5 text-center">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="h3 fw-light mb-3">Sign In</div>
                <!-- Social login links-->
                {{-- <a class="btn btn-icon btn-facebook mx-1" href="#!"><i class="fab fa-facebook-f fa-fw fa-sm"></i></a>
                <a class="btn btn-icon btn-github mx-1" href="#!"><i class="fab fa-github fa-fw fa-sm"></i></a>
                <a class="btn btn-icon btn-google mx-1" href="#!"><i class="fab fa-google fa-fw fa-sm"></i></a>
                <a class="btn btn-icon btn-twitter mx-1" href="#!"><i
                        class="fab fa-twitter fa-fw fa-sm text-white"></i></a> --}}
            </div>
            <hr class="my-0" />
            <div class="card-body p-5">
                <!-- Login form-->
                <form action={{ route('login') }} method="post">
                    @csrf
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="text-gray-600 small" for="emailExample">Email address</label>
                        <input class="form-control @error('email') is-invalid @enderror form-control-solid"
                            value="{{ old('email') }}" type="text" name="email"
                            placeholder="activeemail@gmail.com" aria-label="Email Address"
                            aria-describedby="emailExample" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Form Group (password)-->
                    <div class="mb-3">
                        <label class="text-gray-600 small" for="passwordExample">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror form-control-solid"
                            name="password" type="password" placeholder="********" aria-label="Password"
                            aria-describedby="passwordExample" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Form Group (forgot password link)-->
                    <div class="mb-3">
                        @if (Route::has('password.request'))
                            <a class="small" href={{ route('password.request') }}>
                                Forgot your password?
                            </a>
                        @endif
                    </div>
                    <!-- Form Group (login box)-->
                    <div class="d-flex align-items-center justify-content-between mb-0">
                        <div class="form-check">
                            <input class="form-check-input" id="checkRememberPassword" checked type="checkbox"
                                value="" name="remember" />
                            <label class="form-check-label" for="checkRememberPassword">Remember
                                password</label>
                        </div>
                        <button class="btn btn-primary" href={{ route('login') }}>Login</button>
                    </div>
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
