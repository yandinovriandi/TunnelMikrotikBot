<x-app-layout title="Permintaan Desposit Saldo">
    @pushOnce('script')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
        <script>
            const dataTable = new simpleDatatables.DataTable("#myTableTopup", {
                searchable: true,
                paging: true,
                fixedHeight: true,
            })
        </script>
    @endpushOnce
    @pushOnce('style')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpushOnce
    <x-slot name="header">
        <div class="col-auto mb-3">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                Silahkan Lakukan Topup, {{ auth()->user()->name }}
            </h1>
        </div>
        {{-- <div class="col-12 col-xl-auto mb-3">Optional page header content</div> --}}
    </x-slot>
    <div class="row">
        <div class="col-sm-4">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <div style="padding-top:50px;" align="center">
                        <div class="mb-0 font-weight-bold text-blue-soft"><i class="fa-solid fa-sack-dollar"
                                style="font-size:70px;"></i>
                        </div>
                        <div style="margin-top:20px;" class="text-black">Rp. {{ $saldo }}</div>
                        <p align="center" class="text-blue">Total Saldo</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card sahdow-lg mb-4">
                {{-- <div class="card-header">Basic Card Example</div> --}}
                <div class="card-body">
                    <div class="mb-6">
                        Topup Saldo <span class="badge bg-blue-soft text-blue">{{ auth()->user()->name }}</span>
                    </div>
                    <form action={{ route('topup.create') }} method="post">
                        @csrf
                        <div class="mb-3 mt-4">
                            <label for="amount">Topup Saldo</label>
                            <select name="amount"
                                class="form-control @error('amount')
                                is-invalid
                                    @enderror form-control-solid"
                                {{ old('amount') == 'value' ? 'selected' : '' }} id="amount">
                                <option selected disabled>Jumlah Topup</option>
                                <option value=10000>Rp. 10.000</option>
                                <option value=15000>Rp. 15.000</option>
                                <option value=20000>Rp. 20.000</option>
                                <option value=25000>Rp. 25.000</option>
                                <option value=30000>Rp. 30.000</option>
                                <option value=35000>Rp. 35.000</option>
                                <option value=40000>Rp. 40.000</option>
                                <option value=45000>Rp. 45.000</option>
                                <option value=50000>Rp. 50.000</option>
                            </select>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="method">Topup Saldo</label>
                            <select name="method"
                                class="form-control @error('method') is-invalid @enderror form-control-solid"
                                id="method">
                                <option selected disabled>Metode Pembayaran</option>
                                @foreach ($payments as $payment)
                                    <option value={{ $payment->code }}
                                        {{ old('method') == $payment->code ? 'selected' : '' }}>
                                        {{ $payment->name }}
                                        {{ $payment->group }}
                                @endforeach
                            </select>
                            @error('method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-auth-session-status class="mb-2 mt-2" :status="session('status')" />
                        @error('method')
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <small class="text-danger">
                                    *) Anda tidak dapat melakukan topup sekarang.
                                </small>
                            </div>
                            <div class="alert alert-danger alert-solid" role="alert"> <i
                                    class="fa fa-exclamation-circle fa-sm fa-fw" aria-hidden="true"></i>
                                <b>Peringatan</b>:
                                Anda dapat melakukan topup kembali setelah anda selesaikan pembayaran
                                sebelumnya.
                            </div>
                        @enderror
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm" type="submit">Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mt-4"">
            <div class="card mb-4">
                <div class="card-header"><i class="fa-solid fa-clock-rotate-left"></i> Histories Transaksi
                    Topup</div>
                <div class="card-body">
                    <table id="myTableTopup" class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Invoice</th>
                                <th>Penerbitan Invoice</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->merchant_ref }}</td>
                                    <td>{{ $invoice->created_at->format('d F Y H:i') }}</td>
                                    <td>{{ formatRupiah(abs($invoice->amount)) }}</td>
                                    <td>Rp. {{ formatRupiah(abs($invoice->amount)) }}</td>
                                    <td>
                                        <div
                                            class="badge {{ $invoice->status == 'UNPAID' ? 'bg-warning' : ' bg-success' }} rounded-pill">
                                            {{ strtolower($invoice->status) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($invoice->description == 'Topup Saldo')
                                            <a class="btn btn-sm btn-icon btn-transparent-dark me-2"
                                                href={{ route('topup.show', $invoice->reference) }}>
                                                <i class="fa-regular fa-money-bill-1"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                }, 5000);
            });
        </script>
    @endpushOnce
</x-app-layout>
