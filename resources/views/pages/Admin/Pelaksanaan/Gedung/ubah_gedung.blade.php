@extends('layouts.app')

    @section('title', 'Ubah Gedung')

    @push('style')

    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Gedung</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item active"><a href="{{url('/gedung')}}">Gedung</a></div>
                        <div class="breadcrumb-item">Ubah Gedung</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Gedung</h4>
                            </div>
                        <div class="card-body">
                          <form action="{{route('update.gedung', ['id'=> $gedung->id_gedung])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Gedung</label>
                                <input type="text" autocomplete="off"  name="gedung" value="{{ $gedung->gedung }}" class="form-control @error('gedung')
                                is-invalid
                                @enderror nonAngkaInput" id="gedung"
                                value="{{ old('gedung') }}"
                                autofocus='true'>
                                @error('gedung')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Singkatan</label>
                                <input type="text" autocomplete="off"  name="singkat" value="{{ $gedung->singkat }}" class="form-control @error('singkat')
                                is-invalid
                                @enderror nonAngkaInput" id="singkat"
                                value="{{ old('singkat') }}">
                                @error('singkat')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                @enderror
                            </div>
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <a href="{{route('gedung')}}" type="button" class="btn btn-danger">Batal</a>&nbsp;
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
