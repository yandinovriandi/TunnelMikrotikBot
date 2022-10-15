 <div class="modal fade" id="modalTunnel" tabindex="-1" role="dialog" aria-labelledby="modalTunnelTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-body">
                 <h5 class="modal-title mb-4 text-cyan" id="modalTunnelTitle">Edit Tunnel {{ $tunnel->username }}</h5>
                 <form action={{ route('tunnels.update', $tunnel) }} method="post">
                     @method('put')
                     @csrf
                     <div class="mb-3">
                         <label for="username">Username</label>
                         <input disabled class="form-control
                             id="username" name="username"
                             type="text" placeholder="Username" value="{{ old('username', $tunnel->username) }}">
                     </div>
                     <div class="mb-3">
                         <label for="password">Password</label>
                         <input
                             class="form-control @error('password')
                        is-invalid
                    @enderror"
                             id="password" name="password" value={{ $tunnel->password }} type="text"
                             placeholder="Password">
                         @error('username')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label for="winbox">Port Winbox Default 8291</label>
                         <input class="form-control" id="winbox" name="winbox" type="number" placeholder="winbox"
                             value="{{ old('winbox', $tunnel->to_ports_winbox) }}">
                     </div>
                     <div class="mb-3">
                         <label for="api">Port Api Default 8728</label>
                         <input class="form-control" id="api" name="api" type="number" placeholder="api"
                             value="{{ old('api', $tunnel->to_ports_api) }}">
                     </div>
                     <div class="mb-3">
                         <label for="web">Port Web Default 80</label>
                         <input class="form-control" id="web" name="web" type="number" placeholder="web"
                             value="{{ old('web', $tunnel->to_ports_web) }}">
                     </div>
                     <div class="modal-footer">
                         <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                         <button class="btn btn-sm btn-primary" type="submit">Simpan Perubahan</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
