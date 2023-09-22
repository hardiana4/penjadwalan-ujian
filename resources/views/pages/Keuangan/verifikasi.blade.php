@extends('layouts.app')

@section('title', 'Data Pembayaran Mahasiswa')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pembayaran Mahasiswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Data Pembayaran Mahasiswa</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Lunas</h4>
                            </div>
                            <div class="card-body">{{$dt_lunas}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-x"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Belum Lunas</h4>
                            </div>
                            <div class="card-body"> {{$dt_belum}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pembayaran Mahasiswa</h4>
                            <div class="col box-header text-right">
                                <a href="{{ route('verifikasi') }}" id="bayar" class="btn btn-primary dis disabled"><i
                                        class="fa fa-money-bill-wave"></i &nbsp> Lunas</a>
                                <a href=""class="btn btn-info" data-toggle="modal" data-target="#info">
                                    <i class="fa fa-info"></i> Info
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-all">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5px;">
                                                <div class="custom-checkbox">
                                                    <label>
                                                        <input type="checkbox" class="check" id="checkAll">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($mahasiswa as $m)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="check"
                                                                value="{{ $m->id_mahasiswa }}" name="id_ver" id="test-cb">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $m->nama_mahasiswa }}</td>
                                                <td class="text-center">{{ $m->kelas }}</td>
                                                <td class="text-center">{{ $m->semester }}</td>
                                                @if ($m->status == '1')
                                                    <td class="text-center">
                                                        <div class="badge badge-success">Lunas</div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="badge badge-danger">Belum</div>
                                                    </td>
                                                @endif
                                                @if ($m->status == '1')
                                                    <td class="text-center">
                                                        <a href="" button href=""class="btn btn-danger"
                                                            data-toggle="modal" data-target="#batalkan_{{ $m->id_mahasiswa }}">
                                                            <i class="fa fa-chart-pie"></i> Batalkan</a>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" button href="" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#ubah_{{ $m->id_mahasiswa }}">
                                                                <i class="fa fa-pen"></i></a>
                                                            <a href="" button href="" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#detail_{{ $m->id_mahasiswa }}">
                                                                <i class="fa fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        <a href="" button href="" class="btn btn-warning"
                                                            data-toggle="modal" data-target="#ubah_{{ $m->id_mahasiswa }}">
                                                            <i class="fa fa-pen"></i> Ubah</a>
                                                        <a href="" button href="" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#ubah_{{ $m->id_mahasiswa }}">
                                                        <i class="fa fa-eye"></i>
                                                    </td> --}}
                                                @endif
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
    @include('pages.keuangan.info')
    @foreach ($mahasiswa as $m)
        @include('pages.keuangan.batalkan')
        @include('pages.keuangan.ubah')
        @include('pages.keuangan.detail')
    @endforeach
@endsection

@push('scripts')
    <script>
        $("#checkAll").click(function() {
            $(".check").prop('checked', $(this).prop('checked'));
            toggleDisabledButtons();
        });

        $(".check").change(function() {
            toggleDisabledButtons();
        });

        function toggleDisabledButtons() {
            var checkedCount = $(".check:checked").length;
            var totalCount = $(".check").length;

            if (checkedCount === 0) {
                $("#checkAll").prop('checked', false);
            } else if (checkedCount === totalCount) {
                $("#checkAll").prop('checked', true);
            } else {
                $("#checkAll").prop('checked', false);
            }

            if (checkedCount > 0) {
                $('a.dis').removeClass("disabled");
            } else {
                $('a.dis').addClass("disabled");
            }
        }
    </script>
    <script>
        document.getElementById('bayar').onclick = function() {
            var idnya = [];
            var marked = document.getElementsByName('id_ver');
            for (var checkb of marked) {
                if (checkb.checked) {
                    var id = checkb.value;
                    idnya.push(id);
                }
            }

            var confirmDialog = confirm(
                "Apakah Anda yakin ingin mengubah status bayar mahasiswa yang dipilih menjadi LUNAS ?");
            if (confirmDialog) {
                $.ajax({
                    type: "POST",
                    url: '/lunas',
                    data: {
                        idnya: idnya,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        iziToast.success({
                            title: 'Berhasil',
                            message: 'Data mahasiswa berhasil diperbarui.',
                            position: 'topRight'
                        });
                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                        iziToast.error({
                            title: 'Error',
                            message: 'Terjadi kesalahan dalam memproses data.',
                            position: 'topRight'
                        });
                    },
                });
            } else {
                return false;
            }
        }
    </script>
@endpush
