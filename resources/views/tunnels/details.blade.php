<x-app-layout title="Details Tunnel">
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
                <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                Details Tunnel {{ $tunnel->username }}
            </h1>
        </div>
        <div class="col-12 col-xl-auto mb-3">
            <a class="btn btn-sm btn-light text-primary" href={{ route('tunnels.index') }}>
                <i class="fas fa-long-arrow-alt-left"></i> Kembali
            </a>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-body">
                        <div style="position:relative;height:16rem;width:100%;">
                            <center>
                                <div class="text-center"> <img class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                                        style="width: 11rem;"
                                        src="https://tunnel.hostddns.us/images/undraw_server_cluster_jwwq.svg"
                                        alt="">
                                </div>
                                <h4 class="card-title">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tunnel Remot</div>
                                </h4>
                                <p class="badge bg-success">{{ $tunnel->status }}</p>
                                <p class="text-xs mb-1">
                                    <code>
                                        {{ $tunnel->url }} (api:{{ $p_api['to-ports'] ?? '' }}),
                                        {{ $tunnel->server }}:{{ $p_win['dst-port'] ?? '' }}
                                        (winbox:{{ $p_win['to-ports'] ?? '' }}),
                                        {{ $tunnel->server }}:{{ $p_web['dst-port'] ?? '' }}
                                        (webfig:{{ $p_web['to-ports'] ?? '' }})
                                    </code>
                                </p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <x-auth-session-status class="mb-2 mt-2 alert alert-success alert-solid" :status="session('status')" />
        </div>
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="configurasi-tab" href="#configurasi" data-bs-toggle="tab"
                                role="tab" aria-controls="configurasi" aria-selected="true">Configurasi Script</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="netwatch-tab" href="#netwatch" data-bs-toggle="tab" role="tab"
                                aria-controls="netwatch" aria-selected="true">Netwatch Script</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit_delete-tab" href="#edit_delete" data-bs-toggle="tab"
                                role="tab" aria-controls="edit_delete" aria-selected="false">Edit & Delete</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="cardTabContent">
                        <div class="tab-pane fade show active" id="configurasi" role="tabpanel"
                            aria-labelledby="configurasi-tab">
                            <h5 class="card-title text-xs">Silahkan Copy script di Bawah Ini Paste di terminal
                                mikrotik</h5>
                            <hr>
                            <p class="card-text">
                                <code>
                                    :if ([:len [/ppp profile find name="{{ $tunnel->server }}"]]=0) do={/ppp profile
                                    add
                                    name="{{ $tunnel->server }}" comment="{{ $tunnel->server }}"};/interface
                                    l2tp-client add
                                    user="{{ $tunnel->username }}" password="{{ $tunnel->password }}"
                                    connect-to="{{ $tunnel->server }}" profile={{ $tunnel->server }}
                                    name="l2tp-{{ $tunnel->server }}-{{ $tunnel->username }}" keepalive-timeout=10
                                    use-peer-dns=no disabled=no
                                    comment="{{ $tunnel->server }}-{{ $tunnel->username }} L2TP";
                                </code>
                        </div>
                        <div class="tab-pane fade show" id="netwatch" role="tabpanel" aria-labelledby="netwatch-tab">
                            <h5 class="card-title text-xs">Silahkan Copy script di Bawah Ini Paste di terminal
                                mikrotik</h5>
                            <hr>
                            <p class="card-text">
                            <p class="text-xs"> Di sarankan menggunakan netwatch</p>
                            <p class="text-xs">IP : {{ $secret['local-address'] ?? '' }}</p>
                            <code class="text-xs">
                                /tool netwatch add host="{{ $secret['local-address'] ?? '' }}" interval="00:01:00"
                                comment="mikrotikbot.com"
                            </code>
                        </div>
                        <div class="tab-pane fade" id="edit_delete" role="tabpanel" aria-labelledby="edit_delete-tab">
                            <h5 class="card-title text-sm">Edit & Delete</h5>
                            <p class="card-text text-xs">
                                Silahkan gunakan tombol di bawah untuk melakukan perubahan data tunnel anda, atau jika
                                anda ingin menghapusnya ,
                            </p>
                            <center>
                                <p class="card-text">
                                    <button class="btn btn-sm btn-outline-yellow btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#modalTunnel" type="button">
                                        <i data-feather="edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-red btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#modalDeleteTunnel" type="button">
                                        <i data-feather="trash"></i>
                                    </button>
                                </p>
                            </center>
                        </div>
                        @include('tunnels/modal')
                        @include('tunnels/delete')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Domain Server</b></td>
                                <td><span class="badge bg-purple-soft text-purple">{{ $tunnel->server }}</span></td>
                            </tr>
                            <tr>
                                <td><b>IP Server</b></td>
                                <td><span class="badge bg-purple-soft text-purple">{{ $tunnel->ip_server }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Username</b></td>
                                <td><span class="badge bg-blue-soft text-blue">{{ $tunnel->username }}</span></td>
                            </tr>
                            <tr>
                                <td><b>Password</b></td>
                                <td><span class="badge bg-blue-soft text-blue">{{ $tunnel->password }}</span></td>
                            </tr>
                            <tr>
                                <td><b>Port API</b></td>
                                <td><b><span class="badge bg-purple-soft text-purple"
                                            title="Remote API">{{ $tunnel->server }}:{{ $p_api['dst-port'] }}</span></b>
                                    <i class="fas fa-exchange-alt"></i>
                                    <i><span class="badge bg-red-soft text-red"
                                            title="IP local API">{{ $p_api['to-addresses'] }}:{{ $p_api['to-ports'] }}</span></i>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Port Winbox</b></td>
                                <td><b><span class="badge bg-purple-soft text-purple"
                                            title="Remote Winbox">{{ $tunnel->server }}:{{ $p_win['dst-port'] }}</span></b>
                                    <i class="fas fa-exchange-alt"></i>
                                    <i><span class="badge bg-red-soft text-red"
                                            title="IP Local Winbox">{{ $p_api['to-addresses'] }}:{{ $p_win['to-ports'] }}</span></i>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Port Web</b></td>
                                <td><b><span class="badge bg-purple-soft text-purple"
                                            title="Remote WEB">{{ $tunnel->server }}:{{ $p_web['dst-port'] }}</span></b>
                                    <i class="fas fa-exchange-alt"></i>
                                    <i><span class="badge bg-red-soft text-red"
                                            title="IP Local Web">{{ $p_web['to-addresses'] }}:{{ $p_web['to-ports'] }}</span></i>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Purchase Date</b></td>
                                <td><span
                                        class="badge bg-green-soft text-green">{{ $tunnel->created_at->format('d F Y H:i') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Expired</b></td>
                                <td><span class="badge bg-green-soft text-green">{{ $tunnel->expired }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Period</b></td>
                                <td><span class="badge bg-green-soft text-green">+30 day</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
