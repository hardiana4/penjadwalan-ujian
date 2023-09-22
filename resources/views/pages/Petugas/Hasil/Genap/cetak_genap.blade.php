@extends('layouts.app')

@section('title', 'Cetak Semester Genap')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Cetak Berkas Semester Genap</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Cetak Berkas</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card-cetak gradient-4">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#berkas_uts">
                            <h6 class="card-title text-white">Daftar Pengambilan Berkas</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">UTS</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-folder-open"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card-cetak gradient-5">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#berkas_uas">
                            <h6 class="card-title text-white">Daftar Pengambilan Berkas</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">UAS</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-folder-open"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card-cetak gradient-6">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#jadwal_uts">
                            <h6 class="card-title text-white">Jadwal Ujian per Prodi</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">UTS</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-calendar"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card-cetak gradient-7">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#jadwal_uas">
                            <h6 class="card-title text-white">Jadwal Ujian per Prodi</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">UAS</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-calendar"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.petugas.hasil.genap.berkas_uts')
    @include('pages.petugas.hasil.genap.berkas_uas')
    @include('pages.petugas.hasil.genap.jadwal_uts')
    @include('pages.petugas.hasil.genap.jadwal_uas')
@endsection

@push('scripts')
@endpush
