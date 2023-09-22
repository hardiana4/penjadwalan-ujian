@extends('layouts.app')

@section('title', 'Tambah Prodi')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Prodi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('/prodi') }}">Prodi</a></div>
                    <div class="breadcrumb-item">Tambah Prodi</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Prodi</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.prodi') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Prodi</label><br>
                                    <select name="jenjang"
                                        class="form-control @error('jenjang')
                                is-invalid
                                @enderror"
                                        style="width: 20%; float: left;">
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                    </select>
                                    <input type="text" autocomplete="off"  name="nama_prodi" placeholder="Masukan nama prodi"
                                        class="form-control @error('nama_prodi') is-invalid @enderror nonAngkaInput"
                                        value="{{ old('nama_prodi') }}" style="width: 78%; float: right;" autofocus='true'>
                                    @error('nama_prodi')
                                        <div class='invalid-feedback' style="width: 78%; float: right;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Singkatan</label>
                                    <input type="text" autocomplete="off"  name="singkatan" class="form-control @error('singkatan') is-invalid @enderror nonAngkaInput"
                                        id="singkatan" value="{{ old('singkatan') }}" placeholder="Masukan singkatan prodi">
                                    <span style="color: darkslategrey; font-size: 13px;">contoh: TI, TE, TM, dan lainnya</span>
                                    @error('singkatan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <a href="{{ url('/prodi') }}" button type="button" class="btn btn-danger">Batal</a>&nbsp;
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
