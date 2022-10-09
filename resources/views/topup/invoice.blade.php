<x-app-layout title="Detail Pembayaran">
    <x-slot name="header">
        <div class="col-auto mb-3">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i class="far fa-money-bill-alt"></i>
                </div>
                Nomor Pembayaran, {{ $pay->reference }}
            </h1>
        </div>
        {{-- <div class="col-12 col-xl-auto mb-3">Optional page header content</div> --}}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card-shadow mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <img src={{ asset('assets/img/favicon.png') }} style="width:30px;">
                                <span class="fw-700 font-semibold">{{ config('app.name') }}</span>
                            </div>
                            <div class="col-6 mb-4" align="right">
                                <h3>INVOICE # {{ $pay->merchant_ref }}</h3>
                                Status : <span class="{{ $pay->status == 'UNPAID' ? 'text-red' : 'text-green' }} ">
                                    {{ strtolower($pay->status) }}</span><br>
                                <span class="fw-600">Batas Pembayaran</span> :
                                {{ date('d F Y H:i:s', $pay->expired_time) }}
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 mb-4">
                                <b>Tertuju Kepada :</b><br>
                                {{ $pay->customer_name }}<br>
                                {{ $pay->customer_email }}<br>
                                {{ $pay->customer_phone }}
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 mb-4 table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="10%" align="center"><b>No.</b></th>
                                            <th width="70%" align="center"><b>Keterangan</b></th>
                                            <th width="20%" style="text-align: right;"><b>Jumlah (Rp.)</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pay->order_items as $item)
                                            <tr>
                                                <td align="center">{{ $item->quantity }}</td>
                                                <td>
                                                    {{ $item->name }} {{ formatRupiah($item->price) }}
                                                </td>
                                                <td align="right"> {{ formatRupiah($item->price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th align="right" colspan="2"><b>Total Pembayaran</b></th>
                                            <th align="right" style="text-align: right;">
                                                {{ formatRupiah($pay->amount) }}
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-shadow mb-4">
                    <div class="card-header">
                        Petunjuk Pembayaran
                    </div>
                    {{-- <div class="card-header border-bottom">
                        <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                            @foreach ($pay->instructions as $instruction)
                                <li class="nav-item">
                                    <a class="nav-link {{ $instruction->title ? 'active' : '' }}" id="overview-tab"
                                        href="#{{ $instruction->title }}{{ $loop->iteration }}" data-bs-toggle="tab"
                                        role="tab" aria-controls="{{ $instruction->title }}{{ $loop->iteration }}"
                                        aria-selected="{{ $instruction->title == $instruction->title ? 'true' : 'false' }}">{{ $instruction->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="cardTabContent">
                            @foreach ($instruction->steps as $step)
                                <div class="tab-pane fade show {{ $instruction->title ? 'active' : '' }}"
                                    id="{{ $instruction->title }}{{ $loop->iteration }}" role="tabpanel"
                                    aria-labelledby="overview-tab">
                                    <p class="card-text">{{ $loop->iteration }}. {!! $step !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <i class="fa fa-coins"></i> Pembayaran Otomatis
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="mb-1" for="amount">Lunasi Pembayaran</label>
                        <input disabled class="form-control form-control-solid" value="{{ $pay->payment_method }}">
                    </div>
                    <x-auth-session-status class="mb-2 mt-2" :status="session('status')" />

                    <div class="modal-footer">
                        <a href={{ $pay->checkout_url }} target="_blank" rel="noopener noreferrer"
                            class="btn btn-twitter btn-shadow btn-sm">
                            Bayar
                        </a>
                    </div>
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
