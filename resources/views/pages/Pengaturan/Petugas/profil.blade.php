@extends('layouts.app')

    @section('title', 'Pengaturan')

    @push('style')
    
    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Pengaturan</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item">Pengaturan</div>
                    </div>
                </div>
                <div class="card">
                  <div class="card-header">
                      <h4>Pengaturan</h4>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-4">
                              <div class="list-group"
                                  id="list-tab"
                                  role="tablist">
                                  <a class="list-group-item list-group-item-action active"
                                      id="list-home-list"
                                      data-toggle="list"
                                      href="#list-home"
                                      role="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Profil</a>
                                  <a class="list-group-item list-group-item-action"
                                      id="list-profile-list"
                                      data-toggle="list"
                                      href="#list-profile"
                                      role="tab"><i class="fas fa-key"></i>&nbsp;&nbsp;Kata Sandi</a>
                              </div>
                          </div>
                          <div class="col-8">
                              <div class="tab-content"
                                  id="nav-tabContent">
                                  <div class="tab-pane fade show active"
                                      id="list-home"
                                      role="tabpanel"
                                      aria-labelledby="list-home-list">
                                      <form action="{{route('update.profil',['id'=> $user->id_users])}}" method="POST">
                                    @csrf
                                       @if(Auth::check())
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" autocomplete="off"  name="nama" class="form-control @error('nama')
                                        is-invalid
                                        @enderror" id="nama" 
                                        value="{{ Auth::user()->detail->nama }}"
                                        placeholder="Masukan nama" autocomplete="off">
                                        @error('nama')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                        @enderror
                                    </div>
                                    @endif
                               <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control @error('email')
                                        is-invalid
                                        @enderror" id="email" 
                                        value="{{ $user->email }}"
                                        placeholder="Masukan email " >
                                        @error('email')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                        @enderror
                                </div>
                                <div class="row float-right" style="margin: 0px 0px 25px;">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                                  </div>
                                  <div class="tab-pane fade"
                                      id="list-profile"
                                      role="tabpanel"
                                      aria-labelledby="list-profile-list">
                                      <div class="alert alert-primary alert-dismissible show fade alert-has-icon">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <button class="close"
                                                data-dismiss="alert">
                                                <span>&times;</span>
                                            </button>
                                            Masukan minimal 8 karakter dan gunakan kombinasi huruf kapital, huruf kecil, angka, dan simbol.
                                        </div>
                                    </div>
                                    <form action="{{route('update.password',['id'=> $user->id_users])}}" method="POST">
                                        @csrf
                                      <div class="form-group">
                                        <label>Kata Sandi Lama</label>
                                        <input type="password" name="password_lama" class="form-control @error('password_lama')
                                        is-invalid
                                        @enderror" id="password_lama" 
                                        autofocus='true' placeholder="Masukan kata sandi lama">
                                        @error('password_lama')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                        @enderror
                                    </div>
                               <div class="form-group">
                                        <label>Kata Sandi Baru</label>
                                        <input type="password" name="password_baru" class="form-control @error('password_baru')
                                        is-invalid
                                        @enderror" id="password_baru" 
                                        value="{{ old('password_baru') }}"
                                        placeholder="Masukan kata sandi baru" >
                                        @error('password_baru')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                        @enderror
                                </div>
                               <div class="form-group">
                                        <label>Konfirmasi Kata Sandi Baru</label>
                                        <input type="password" name="password_konfirmasi" class="form-control @error('password_konfirmasi')
                                        is-invalid
                                        @enderror" id="password_konfirmasi" 
                                        value="{{ old('password_konfirmasi') }}"
                                        placeholder="Masukan kata sandi baru" >
                                        @error('password_konfirmasi')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                        @enderror
                                </div>
                                <div class="row float-right" style="margin: 0px 0px 25px;">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </section>
        </div>   
        @endsection

