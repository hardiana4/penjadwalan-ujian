@extends('layouts.app')

    @section('title', 'Prodi')

    @push('style')

    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Prodi</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item">Prodi</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Prodi</h4>
                            <div class="col box-header text-right">
                                <a href="{{route('tambah.prodi')}}" class="btn btn-primary"><i class="fa fa-plus" ></i &nbsp> Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped"
                                    id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Prodi</th>
                                            <th class="text-center">Singkatan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($prodi as $p)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$p->prodi}}</td>
                                            <td class="text-center">{{$p->singkatan}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{route('ubah.prodi', ['id'=> $p->id_prodi])}}" button href=""class="btn btn-warning">
                                                    <i class="fa fa-pen-to-square"></i></a>
                                                <button href=""class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus_prodi_{{ $p->id_prodi }}">
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
        @foreach ($prodi as $p)
        @include('pages.admin.kelola.prodi.hapus_prodi')
        @endforeach
        @endsection



