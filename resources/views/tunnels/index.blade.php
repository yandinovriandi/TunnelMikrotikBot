<x-app-layout title="Daftar Tunnel">
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
                <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                Daftar Tunnel Anda
            </h1>
        </div>
        <div class="col-12 col-xl-auto mb-3">
            <a class="btn btn-sm btn-light text-primary" href={{ route('tunnels.create') }}>
                Buat Tunnel <i class="fas fa-long-arrow-alt-right me-1"></i>
            </a>
        </div>
    </x-slot>
    <x-auth-session-status class="mb-2 mt-2" :status="session('status')" />
    <div class="row">
        <div class="mt-4"">
            <div class="card mb-4">
                <div class="card-header"><i class="fa-solid fa-clock-rotate-left"></i> Daftar Tunnels
                    {{ auth()->user()->name }}</div>
                <div class="card-body">
                    <table id="myTableTopup" class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Url/Remote Api</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tunnels as $tunnel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tunnel->username }}</td>
                                    <td>{{ $tunnel->password }}</td>
                                    <td class="d-flex items-center align-items-center"><span
                                            class="badge bg-orange mr-1">{{ $tunnel->url }}:{{ $tunnel->api }}</span>
                                        <i class="fas fa-exchange-alt"></i> <span class="badge bg-teal ml-1">
                                            {{ $tunnel->to_ports_api }}</span></td>
                                    <td>
                                        <div
                                            class="badge {{ $tunnel->status == 'UNPAID' ? 'bg-warning' : ' bg-success' }} rounded-pill">
                                            {{ strtolower($tunnel->status) }}
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                            href={{ route('tunnels.show', $tunnel->username) }}>
                                            <i class="far fa-file-alt"></i>
                                        </a>
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
