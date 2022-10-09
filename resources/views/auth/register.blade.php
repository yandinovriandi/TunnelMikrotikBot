<x-guest-layout>
    <div class="col-xl-8 col-lg-9">
        <!-- Social registration form-->
        <div class="card my-5">
            <div class="card-body p-5 text-center">
                <div class="h3 fw-light mb-3">Create an Account</div>
            </div>
            <hr class="my-0" />
            <div class="card-body p-5">
                <div class="text-center small text-muted mb-4">...or enter your information below.</div>
                <!-- Login form-->
                <form action={{ route('register') }} method="post">
                    @csrf
                    <!-- Form Row-->
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <!-- Form Group (first name)-->
                            <div class="mb-3">
                                <label class="text-gray-600 small" for="Name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror form-control-solid"
                                    name="name" type="text" value="{{ old('name') }}" placeholder=""
                                    aria-label="Name" aria-describedby="Name" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (last name)-->
                            <div class="mb-3">
                                <label class="text-gray-600 small" for="Phone">No Handphone</label>
                                <input class="form-control @error('phone') is-invalid @enderror form-control-solid"
                                    type="number" name="phone" placeholder="" value="{{ old('phone') }}"
                                    aria-label="Phone" aria-describedby="Phone" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="text-gray-600 small" for="email">Email address</label>
                        <input class="form-control @error('email') is-invalid @enderror form-control-solid"
                            name="email" type="text" placeholder="" value="{{ old('email') }}"
                            aria-label="Email Address" aria-describedby="email" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <!-- Form Group (choose password)-->
                            <div class="mb-3">
                                <label class="text-gray-600 small" for="passwordExample">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror form-control-solid"
                                    name="password" type="password" placeholder="" aria-label="Password"
                                    aria-describedby="passwordExample" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
                    </div>
                    <!-- Form Group (form submission)-->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" id="checkTerms" type="checkbox" value="" />
                            <label class="form-check-label" for="checkTerms">
                                I accept the
                                <a href="#!">terms &amp; conditions</a>
                                .
                            </label>
                        </div>
                        <button class="btn btn-primary" href={{ 'register' }}>Create Account</button>
                    </div>
                </form>
            </div>
            <hr class="my-0" />
            <div class="card-body px-5 py-4">
                <div class="small text-center">
                    Have an account?
                    <a href={{ route('login') }}>Sign in!</a>
                </div>
            </div>
        </div>
</x-guest-layout>
