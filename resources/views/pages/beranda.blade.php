@extends('layouts.app')

@section('title', 'Beranda')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Beranda</h1>
            </div>
            @if ($user->level == 'admin')
                <h6>KELOLA</h6>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Prodi</h4>
                                </div>
                                <div class="card-body">
                                    {{$dt_prodi}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-user-group"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengguna</h4>
                                </div>
                                <div class="card-body">
                                    {{$dt_pengguna}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Mahasiswa</h4>
                                </div>
                                <div class="card-body">
                                    {{$dt_mahasiswa}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h6>PELAKSANAAN</h6>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-pink">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Gedung</h4>
                                </div>
                                <div class="card-body">
                                    {{$dt_gedung}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-door-closed"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Ruangan</h4>
                                </div>
                                <div class="card-body">
                                    {{$dt_ruangan}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Mata Kuliah</h4>
                                </div>
                                <div class="card-body">
                                    {{$dt_matakuliah}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- <h6>HASIL</h6>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-purple">
                                <i class="fas fa-address-card"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Kartu Ujian</h4>
                                </div>
                                <div class="card-body">
                                    1,201
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @elseif($user->level == 'petugas')
                <div class="card">
                    <div class="card-body">
                        <center>
                            <img src="img/aturan.png" alt="aturan-penjadwalan" width="100%;" style="border-radius: 10px;">
                        </center>
                    </div>
                </div>
                {{-- <h6>PENJADWALAN</h6>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-magenta">
                                <i class="fas fa-timeline"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Sesi</h4>
                                </div>
                                <div class="card-body">
                                    10
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-dark">
                                <i class="fas fa-user-secret"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengawas</h4>
                                </div>
                                <div class="card-body">
                                    10
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h6>HASIL</h6>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-table-list"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jadwal Ujian</h4>
                                </div>
                                <div class="card-body">
                                    1,201
                                </div>
                            </div>
                        </div>
                    </div> --}}
            @endif
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        @if (session()->has('success'))
            iziToast.success({
                title: "Berhasil",
                message: "{{ session('success') }}",
                position: "topRight"
            });
        @endif
    </script>
@endpush
