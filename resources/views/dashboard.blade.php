<x-app-layout title="Dashboard">
    <x-slot name="header">
        <div class="col-auto mb-3">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i data-feather='sun'></i>
                </div>
                Hai, {{ auth()->user()->name }}
            </h1>
        </div>
        {{-- <div class="col-12 col-xl-auto mb-3">Optional page header content</div> --}}
    </x-slot>

    @if (session('status'))
        <div class="alert alert-green" role="alert"> {{ session('status', auth()->user()->name) }}</div>
    @endif
    @if (session('status-error'))
        <div class="alert alert-danger border-bottom-danger">
            {{ session('status-error') }}
        </div>
    @endif
    @if (auth()->user()->email_verified_at == null)
        <div class="mb-9">
            <div class="verifikasi alert-danger rounded" role="alert">
                <div class="p-2">
                    <h4 class="alert-heading">Perhatian!</h4>
                    <p>Akun anda belum terverifikasi, silahkan lakukan verifikasi terlebih dahulu.</p>
                    <hr>
                    <p class="mb-0">Cek inbox pada email:<span
                            class="badge bg-info">{{ auth()->user()->email }}</span>
                        anda yang terdaftar.</p>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-4">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Jumlah Saldo</div>
                            <div class="text-lg fw-bold">Rp. {{ $saldo }}</div>
                        </div>
                        <i class="fas fa-wallet fa-2xl"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href={{ route('topup.create') }}>Lihat Rincian</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Tunnels Remot</div>
                            <div class="text-lg fw-bold">{{ $tunnel }}</div>
                        </div>
                        <i class="fas fa-network-wired fa-2xl"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href={{ route('tunnels.index') }}>View Detail</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Invoice Belum Lunas</div>
                            <div class="text-lg fw-bold">{{ $invoicePending }}</div>
                        </div>
                        <i class="fas fa-money-check-alt fa-2xl"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href={{ route('topup.create') }}>Lihat Invoice</a>
                    <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Hosting Mikrotik</div>
                            <div class="text-lg fw-bold">0</div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-message-circle feather-xl text-white-50">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="#!">Dalam Persiapan</a>
                    <div class="text-white">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-shadow">
        <div class="card">
            <div class="card-header">
                Histori transaksi
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Pembayaran</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $invoice->reference }}</td>
                                <td>{{ $invoice->method }}</td>
                                <td>{{ $invoice->description }}</td>
                                <td>{{ $invoice->created_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div
                                        class="badge {{ $invoice->status == 'UNPAID' ? 'bg-warning' : ' bg-success' }} rounded-pill">
                                        {{ strtolower($invoice->status) }}
                                    </div>
                                </td>
                                <td>
                                    @if ($invoice->description == 'Topup Saldo')
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                            href={{ route('topup.show', $invoice->reference) }}>
                                            <i class="far fa-file-alt"></i>
                                        </a>
                                    @else
                                        <button disabled class="btn btn-datatable btn-icon btn-transparent-dark me-2">
                                            <i class="far fa-file-alt"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @pushOnce('script')
        <script type="text/javascript">
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(3000, 0).slideUp(1000, function() {
                        $(this).remove();
                    });
                }, 6000);
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".verifikasi").fadeTo(3000, 0).slideUp(1000, function() {
                        $(this).remove();
                    });
                }, 15000);
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src={{ asset('js/datatables/datatables-simple-demo.js') }}></script>
    @endpushOnce
</x-app-layout>
