<x-guest-layout>
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
        <!-- Social login form-->
        <div class="card my-5">
            <div class="card-body p-5 text-center">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="h3 fw-light mb-3">Verifikasi Email</div>
            </div>
            <hr class="my-0" />
            <div class="card-body p-5">
                <div class="text-center small text-muted mb-4">Email verifikasi telah di kirimkan ke email anda, jika
                    anda bleum menerima nya, silahkan klik tombol resend.</div>
                <!-- Forgot password form-->
                <form method="POST" action={{ route('verification.send') }}>
                    @csrf
                    <button class="btn
                            btn-primary">Resend verification email</button>
                </form>
            </div>
            <hr class="my-0" />
            <div class="card-body px-5 py-4">
                <div class="small text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
