<div class="modal fade" id="resetpw" tabindex="-1" role="dialog" aria-labelledby="resetpw" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelmodal">
          <img src="img/SIP UJIANpnc.png" alt="logo-sipu" style="width: 100px;"></h5>
      </div>
      <div class="modal-body">
        <h5>Selamat datang di <span style="font-weight: bold;">SIP UJIAN</span>!<br>
        Silakan masuk terlebih dulu &#127774;</h5><br>
          <form action="{{url('masuk/proses')}}" method="post" class="needs-validation" novalidate>
            @csrf
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                      <div class="input-group-text">@</div>
                  </div>
                    <input id="email"type="email" name="email"  value="{{ old('email') }}" class="form-control @error('email')is-invalid @enderror" tabindex="1" required  autofocus = "true" placeholder="Email"> 
                    @error('email')
                      <div class='invalid-feedback'>
                        {{ $message }}
                      </div>
                    @enderror
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="ri-key-2-fill"></i>
                    </div>
                  </div>
                  <input id="password" type="password" class="form-control has-validation" name="password" tabindex="2" placeholder="Kata Sandi" required >
                  <div class="invalid-feedback"> 
                    Silakan isi Kata Sandi Anda
                  </div>
                </div>
                <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="myPassword()">
                    <label class="custom-control-label" for="customCheck1">Lihat Password</label>
                </div>
              </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="font-weight: bold;" tabindex="4">Masuk</button>
              <div class="modal-footer"></div>
          </form>
        </div>
     </div>
  </div>
</div>