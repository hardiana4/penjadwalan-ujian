@extends('layouts.app')

@section('title', 'Tambah Ruangan')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ruangan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('/ruangan') }}">Ruangan</a></div>
                    <div class="breadcrumb-item">Tambah Ruangan</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.ruangan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Gedung</label><br>
                                        <select
                                            class="form-control selectric
                                @error('id_gedung') is-invalid @enderror"
                                            name="id_gedung" id="id_gedung" placeholder="- Pilih Gedung -">
                                            <option value="">- Pilih Gedung -</option>
                                            @foreach ($gedung as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ old('id_gedung') == $data->id ? 'selected' : '' }}>
                                                    {{ $data->singkat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_gedung')
                                            <div class='invalid-feedback d-block'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Ruangan</label>
                                    <input type="text" autocomplete="off"  name="ruangan"
                                        class="form-control @error('ruangan')
                                is-invalid
                                @enderror"
                                        id="ruangan" value="{{ old('ruangan') }}" autofocus='true'
                                        placeholder="Masukan nama ruangan">
                                    @error('ruangan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <a href="{{ url('/ruangan') }}" type="button" class="btn btn-danger">Batal</a>&nbsp;
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
