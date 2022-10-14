<div class="modal fade" id="modalDeleteTunnel" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTunnelTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title mb-4 text-cyan" id="modalDeleteTunnelTitle">Anda yankin akan menghapus Tunnel
                    {{ $tunnel->username }} ?
                </h5>
                <div class="p-8 text-center">
                    <form action={{ route('tunnels.delete', $tunnel) }} method="post">
                        @method('delete')
                        @csrf
                        <div class="mb-6">
                            <center>
                                <button class="btn btn-sm btn-outline-orange btn-icon" type="button"
                                    data-bs-dismiss="modal"> <i data-feather="slash"></i></button>
                                <button class="btn btn-sm btn-outline-green btn-icon" type="submit">
                                    <i data-feather="check-circle"></i>
                                </button>
                            </center>
                        </div>
                    </form>
                    <div class="modal-footer mt-4">
                        Anda akan menghapus salah satu akun tunnel anda, lanjutkan jika anda yakin.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
