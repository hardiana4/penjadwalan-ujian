@extends('layouts.app')

    @section('title', 'Tahun Pelajaran')

    @push('style')
    
    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Tahun Pelajaran</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item">Tahun Pelajaran</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Tahun Pelajaran</h4>
                            </div>
                        <div class="card-body">
                          <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label>Gedung</label>
                              <div class="selectgroup w-100">
                                  <label class="selectgroup-item">
                                    <input type="radio" name="gedung" value="GKB" {{($tapel->gedung == 'GKB')? 'checked': ''; }} class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">GKB</span>
                                  </label>
                                  <label class="selectgroup-item">
                                    <input type="radio" name="gedung" value="GTIL" {{($tapel->gedung == 'GTIL')? 'checked': ''; }} class="selectgroup-input">
                                    <span class="selectgroup-button">GTIL</span>
                                  </label>
                              </div>
                          </div>
                            <div class="form-group">
                                <label>Ruangan</label>
                                <input type="text" autocomplete="off"  name="ruangan" value="{{ $tapel->ruangan }}" class="form-control @error('ruangan')
                                is-invalid
                                @enderror" id="ruangan" 
                                value="{{ old('ruangan') }}"
                                autofocus='true' placeholder="Masukan ruangan prodi">
                                @error('ruangan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                @enderror
                            </div>
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <a href="" type="button" class="btn btn-danger">Batal</a>&nbsp;
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>   
        @endsection