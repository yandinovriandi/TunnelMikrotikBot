<x-guest-layout>
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-body text-center p-5">
                <div class="spinner-border mb-3" role="status"><span class="visually-hidden">Loading...</span></div>
                <p class="mb-0">Thanks for logging in!</p>
                <p class="mb-0">Redirecting you back to the app...</p>
                <a href={{ route('dashboard') }}>Lanjutkan Ke Dashboard</a>
            </div>
        </div>
    </div>
</x-guest-layout>
