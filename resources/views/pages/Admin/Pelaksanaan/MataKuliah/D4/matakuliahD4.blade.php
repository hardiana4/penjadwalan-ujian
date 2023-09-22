@extends('layouts.app')

@section('title', 'Mata Kuliah Prodi D4')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mata Kuliah Prodi D4</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Mata Kuliah Prodi D4</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mata Kuliah</h4>
                            <div class="col box-header text-right">
                                <a href="{{ route('tambah.matakuliahD4') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i &nbsp> Tambah</a>
                                <a href="" class="btn btn-success" data-toggle="modal" data-target="#importExcel"><i
                                        class="fa fa-file-import"></i &nbsp> Import Excel</a>
                                <a href="{{ route('matakuliah.D4') }}" id="deleteMtk" class="btn btn-danger dis disabled"><i
                                        class="fa fa-dumpster-fire"></i &nbsp> Hapus Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
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
                                            <th>Prodi</th>
                                            <th>Semester</th>
                                            <th class="text-center">Mata Kuliah</th>
                                            <th class="text-center" style="position:sticky">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($matakuliah as $m)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="check"
                                                                value="{{ $m->id_matakuliah }}" name="id_mtk" id="test-cb">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $m->prodi->prodi }}</td>
                                                <td>{{ $m->semester }}</td>
                                                <td class="text-center">{{ $m->matakuliah }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a
                                                            href="{{ route('ubah.matakuliahD4', ['id' => $m->id_matakuliah]) }}"class="btn btn-warning">
                                                            <i class="fa fa-pen-to-square"></i>
                                                        </a>
                                                        <a href=""class="btn btn-danger" data-toggle="modal"
                                                            data-target="#hapus_matakuliah_{{ $m->id_matakuliah }}">
                                                            <i class="fa fa-trash-can"></i>
                                                        </a>
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
    @foreach ($matakuliah as $m)
        @include('pages.admin.pelaksanaan.matakuliah.D4.hapus_MatakuliahD4')
        @endforeach
        @include('pages.admin.pelaksanaan.matakuliah.D4.importMtkD4')
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
        document.getElementById('deleteMtk').onclick = function() {
            var idnya = [];
            var marked = document.getElementsByName('id_mtk');
            for (var checkb of marked) {
                if (checkb.checked) {
                    var id = checkb.value;
                    idnya.push(id);

                }
            }

           var confirmDialog = confirm("Apakah Anda yakin ingin menghapus seluruh data mata kuliah yang dipilih?");

            if (confirmDialog) {

            $.ajax({
                type: "POST",
                url: '/checkhapus-matakuliah',
                data: {
                    idnya: idnya,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    iziToast.success({
                        title: 'Berhasil',
                        message: 'Data mata kuliah berhasil dihapus.',
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
