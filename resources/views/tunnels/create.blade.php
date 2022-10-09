<x-app-layout title="Buat Tunnel Baru">
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
    <x-slot name="header">
        <div class="col-auto mb-3">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i class="fas fa-network-wired"></i>
                </div>
                Silahkan Buat Tunnel anda, {{ auth()->user()->name }}
            </h1>
        </div>
        {{-- <div class="col-12 col-xl-auto mb-3">Optional page header content</div> --}}
    </x-slot>

    <div class="row">
        <div class="col-xl-8 older-xl-4 mb-4">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-body">
                        <form action={{ route('tunnels.store') }} method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="server">Server</label>
                                <select
                                    class="form-control @error('server')
                                    is-invalid
                                @enderror"
                                    name="server" id="server">
                                    <option disabled selected>Pilih Server Tunnel Anda</option>
                                    <option value='sg1.mikrotikbot.com'>SG-1</option>
                                    <option disabled>ID-1 FULL </option>
                                    <option disabled>SG-2 FULL </option>
                                </select>
                                @error('server')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input
                                    class="form-control @error('username')
                                is-invalid
                            @enderror"
                                    id="username" name="username" type="text" placeholder="Username"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input
                                    class="form-control @error('password')
                                is-invalid
                            @enderror"
                                    id="password" name="password" type="text" placeholder="Password">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check form-check-solid mb-3">
                                <input
                                    class="form-check-input @error('perpanjangOtomatis')
                                is-invalid
                                @enderror"
                                    id="perpanjangOtomatis" type="checkbox" name="perpanjangOtomatis" value=""
                                    checked">
                                <label class="form-check-label" for="perpanjangOtomatis">Perpanjang Otomatis</label>
                                @error('perpanjangOtomatis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input disabled class="form-control" value="Rp. 5.000">
                            </div>
                            <x-auth-session-status class="mb-2 mt-2 alert alert-danger alert-solid" :status="session('status')" />
                            <button class="btn btn-sm btn-primary">Buat</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 older-xl-5 mb-4">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-body">
                        <div class="card-body"> <small><i class="fas fa-dot-circle fa-fw" style="font-size:10px;"
                                    aria-hidden="true"></i> <b>Tunnel Remot : </b> Tunnel Remot yang anda buat memiliki
                                akses 3 port <b>Winbox, Api , Web</b>. </small><br> <small><i
                                    class="fas fa-dot-circle fa-fw" style="font-size:10px;" aria-hidden="true"></i>
                                <b>Port Akses : </b> Anda tidak perlu membuat beberapa tunnel jika membuatuhkan
                                3 port
                                tersebut cukup buat satu saja.</small><br>
                            <small>
                                <i class="fas fa-dot-circle fa-fw" style="font-size:10px;" aria-hidden="true"></i>
                                <b>Masa Berlaku : </b>
                                Tunnel memilik masa aktif satu bulan untuk itu perhatikan akun anda jika tidak melakukan
                                perpanjangan otomatis akun tunnel akan terhapus.
                            </small><br>
                            <small>
                                <b>Harap diperhatikan kembali data yang anda isi sebelum
                                    order vpn !!!
                                </b>
                            </small><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
