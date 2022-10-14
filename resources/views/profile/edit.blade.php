<x-app-layout>
    @pushOnce('script')
        <script type="text/javascript">
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(3000, 0).slideUp(1000, function() {
                        $(this).remove();
                    });
                }, 5000);
            });
        </script>
    @endpushOnce
    <x-slot name='header'>
        <div class="col-auto mb-3">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i data-feather="user"></i> <i data-feather="key"></i>
                </div>
                Perbaharui Profile & Password,
                {{ auth()->user()->name }}
            </h1>
        </div>
        <div class="col-12 col-xl-auto mb-3">
            <a class="btn btn-sm btn-light text-primary" href={{ route('dashboard') }}>
                <i class="fas fa-long-arrow-alt-left"></i> Kembali
            </a>
        </div>
    </x-slot>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-bottom">
                <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" href="#overview" data-bs-toggle="tab"
                            role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" href="#password" data-bs-toggle="tab" role="tab"
                            aria-controls="password" aria-selected="false">Password</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                        aria-labelledby="overview-tab">
                        <h5 class="card-title">Perbaharui Data Profile</h5>
                        <p class="card-text">
                        <form action={{ route('profile.edit', $user) }} method="post">
                            @csrf
                            @method('put')
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="username">Username (username adalah tanda pengenal/alias
                                    untuk akun anda.)</label>
                                <input
                                    class="form-control @error('username')
                                        is-invalid
                                    @enderror"
                                    id="username" name="username" type="text"
                                    placeholder="Silahkan isi username anda"
                                    value="{{ old('username', $user->username) }}" />
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Alamat Email</label>
                                <input disabled class="form-control" id="email" type="email" name="email"
                                    placeholder="Masukan Email anda" value="{{ old('email', $user->email) }}" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="phone">Nomor Handphone</label>
                                <input
                                    class="form-control @error('phone')
                                        is-invalid
                                    @enderror"
                                    id="phone" type="phone" name="phone"
                                    placeholder="Masukan Nomoe Handphone anda"
                                    value="{{ old('phone', $user->phone) }}" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <x-auth-session-status class="mb-2 mt-2 alert alert-success alert-solid"
                                :status="session('status')" />
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <h5 class="card-title">Silahkan Perbaharui Password Anda</h5>
                        <p class="card-text">
                        <form action={{ route('profilePassword.update', $user) }} method="POST">
                            @csrf
                            @method('put')
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="current_password">Current Password</label>
                                <input disabled class="form-control" id="current_password" type="password"
                                    placeholder="Password Lama Anda">
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="new_password">New Password</label>
                                <input disabled class="form-control" id="new_password" type="password"
                                    placeholder="Password Baru">
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="new_confirm_password">Confirm Password</label>
                                <input disabled class="form-control" id="new_confirm_password" type="password"
                                    placeholder="Confirm Passwor Baru Anda">
                            </div>
                            <x-auth-session-status class="mb-2 mt-2 alert alert-success alert-solid"
                                :status="session('status')" />
                            <button disabled class="btn btn-primary" type="submit">Perbaharui</button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
