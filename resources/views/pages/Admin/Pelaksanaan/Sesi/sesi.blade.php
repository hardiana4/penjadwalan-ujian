@extends('layouts.app')

    @section('title', 'Sesi')

    @push('style')

    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Sesi</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item">Sesi</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Sesi</h4>
                            <div class="col box-header text-right">
                                <a href="{{route('tambah.sesi')}}" class="btn btn-primary"><i class="fa fa-plus" ></i &nbsp> Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped"
                                    id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Mulai</th>
                                            <th class="text-center">Selesai</th>
                                            <th class="text-center">Sesi</th>
                                            <th class="text-center">Urutan Sesi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($sesi as $s)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td class="text-center">{{$s->waktu_awal}}</td>
                                            <td class="text-center">{{$s->waktu_akhir}}</td>
                                            <td class="text-center">{{$s->sesi}}</td>
                                            <td class="text-center">{{$s->urutan}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{route('ubah.sesi', ['id'=> $s->id_sesi])}}" button href=""class="btn btn-warning">
                                                    <i class="fa fa-pen-to-square"></i></a>
                                                    <button href=""class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus_sesi_{{ $s->id_sesi }}">
                                                    <i class="fa fa-trash-can"></i>
                                                </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        @foreach ($sesi as $s)
        @include('pages.admin.pelaksanaan.sesi.hapus_sesi')
        @endforeach
        @endsection



