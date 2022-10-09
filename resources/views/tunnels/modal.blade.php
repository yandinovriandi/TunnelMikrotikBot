 <div class="modal fade" id="modalTunnel" tabindex="-1" role="dialog" aria-labelledby="modalTunnelTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-body">
                 <h5 class="modal-title mb-4 text-cyan" id="modalTunnelTitle">Edit Tunnel {{ $tunnel->username }}</h5>
                 <form action={{ route('tunnels.update', $tunnel) }} method="post">
                     @method('patch')
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
                     <div class="modal-footer">
                         <button class="btn btn-sm btn-secondary" type="button"
                             data-bs-dismiss="modal">Batal</button><button class="btn btn-sm btn-primary"
                             type="submit">Simpan Perubahan</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
