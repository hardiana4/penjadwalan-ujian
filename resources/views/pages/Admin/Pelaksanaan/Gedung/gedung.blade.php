@extends('layouts.app')

    @section('title', 'Gedung')

    @push('style')

    @endpush

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Gedung</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{url('/beranda')}}">Beranda</a></div>
                        <div class="breadcrumb-item">Gedung</div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Gedung</h4>
                            <div class="col box-header text-right">
                                <a href="{{route('tambah.gedung')}}" class="btn btn-primary"><i class="fa fa-plus" ></i &nbsp> Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped"
                                    id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Gedung</th>
                                            <th>Singkatan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($gedung as $g)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$g->gedung}}</td>
                                            <td>{{$g->singkat}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{route('ubah.gedung', ['id'=> $g->id_gedung])}}" button href=""class="btn btn-warning">
                                                    <i class="fa fa-pen-to-square"></i></a>
                                                <button href=""class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus_gedung_{{ $g->id_gedung }}">
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
        @foreach ($gedung as $g)
        @include('pages.admin.pelaksanaan.gedung.hapus_gedung')
        @endforeach
        @endsection



