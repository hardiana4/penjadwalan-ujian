@extends('layouts.app')

@section('title', 'Mata Kuliah Prodi D4')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan Mata Kuliah Prodi D4</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Penjadwalan Mata Kuliah</div>
                    <div class="breadcrumb-item">D4</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mata Kuliah</h4>
                            <div class="col box-header text-right">
                                <a href="{{ route('tambah.trmatakuliahD4') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i &nbsp> Tambah</a>
                                <a href="{{ route('trmatakuliahD4') }}" id="deletePMatkul" class="btn btn-danger dis disabled"><i
                                        class="fa fa-dumpster-fire"></i &nbsp> Hapus Semua</a>
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
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">Mata Kuliah</th>
                                            <th class="text-center">Pengampu</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Sesi</th>
                                            {{-- <th class="text-center">Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($tr_matakuliah as $m)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="check"
                                                                value="{{ $m->id_trmatakuliah }}" name="id_trmk" id="test-cb">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td class="text-center">{{ $m->kelas }}</td>
                                                <td class="text-center">{{ $m->semester }}</td>
                                                <td >{{ $m->matkul->matakuliah }}</td>
                                                <td >{{ $m->pengawas->detail->nama }}</td>
                                                <td class="text-center">{{ $m->tgl_ujian }}</td>
                                                <td class="text-center">{{ $m->sesi->sesi }}</td>
                                                {{-- <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('ubah.trmatakuliahD4', ['id' => $m->id_trmatakuliah]) }}"class="btn btn-warning">
                                                            <i class="fa fa-pen-to-square"></i>
                                                        </a>
                                                        <a href=""class="btn btn-danger" data-toggle="modal"
                                                            data-target="#hapus_trmatakuliah_{{ $m->id_trmatakuliah }}">
                                                            <i class="fa fa-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </td> --}}
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
    @foreach ($tr_matakuliah as $m)
        @include('pages.petugas.jadwal.matakuliah.D4.hapus_trmatakuliahD4')
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
        document.getElementById('deletePMatkul').onclick = function() {
            var idnya = [];
            var marked = document.getElementsByName('id_trmk');
            for (var checkb of marked) {
                if (checkb.checked) {
                    var id = checkb.value;
                    idnya.push(id);

                }
            }

            var confirmDialog = confirm(
                "Apakah Anda yakin ingin menghapus seluruh data penjadwalan matakuliah yang dipilih?");

            if (confirmDialog) {
                $.ajax({
                    type: "POST",
                    url: '/checkhapus-trmatkul',
                    data: {
                        idnya: idnya,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        iziToast.success({
                            title: 'Berhasil',
                            message: 'Data penjadwalan matakuliah berhasil dihapus.',
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
