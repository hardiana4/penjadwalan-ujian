@extends('layouts.app')

@section('title', 'Mahasiswa Prodi D3')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mahasiswa Prodi D3</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Mahasiswa Prodi D3</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mahasiswa</h4>
                            <div class="col box-header text-right">
                                <a href="{{ route('tambah.mahasiswaD3') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i &nbsp> Tambah</a>
                                <a href="" class="btn btn-success" data-toggle="modal" data-target="#importExcel"><i
                                        class="fa fa-file-import"></i &nbsp> Import Excel</a>
                                <a href="{{ route('mahasiswa.D3') }}" id="deleteMhs" class="btn btn-danger dis disabled"><i
                                        class="fa fa-dumpster-fire"></i &nbsp> Hapus Semua</a>
                                <a href="{{ route('mahasiswa.D3') }}" id="push" class="btn btn-dark dis disabled"><i
                                        class="fa fa-arrow-up-right-dots"></i &nbsp> Naik Semester</a>
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
                                            <th>Nama</th>
                                            <th>NPM</th>
                                            <th>Prodi</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Semester</th>
                                            <th>Dosen Wali</th>
                                            <th>Status</th>
                                            <th class="text-center" style="position:sticky">Aksi</th>
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
                                                                value="{{ $m->id_mahasiswa }}" name="id_mhs" id="test-cb">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $m->nama_mahasiswa }}</td>
                                                <td>{{ $m->npm }}</td>
                                                <td>{{ $m->prodi->prodi }}</td>
                                                <td class="text-center">{{ $m->kelas }}</td>
                                                <td class="text-center">{{ $m->semester }}</td>
                                                <td>{{ $m->user->detail->nama }}</td>
                                                @if ($m->status == '1')
                                                    <td class="text-center">
                                                        <div class="badge badge-success">Lunas</div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="badge badge-danger">Belum</div>
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Aksi
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ route('ubah.mahasiswaD3', ['id' => $m->id_mahasiswa]) }}"><i
                                                                    class="fas fa-pen"></i> Ubah</a>
                                                            <a class="dropdown-item has-icon" href=""
                                                                data-toggle="modal"
                                                                data-target="#hapus_mahasiswa_{{ $m->id_mahasiswa }}"><i
                                                                    class="fas fa-trash"></i> Hapus</a>
                                                            @if ($m->status == '0')
                                                                <a class="dropdown-item has-icon" href=""
                                                                    data-toggle="modal"
                                                                    data-target="#detail_{{ $m->id_mahasiswa }}"><i
                                                                        class="fas fa-info"></i> Detail</a>
                                                            @endif
                                                        </div>
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
    @foreach ($mahasiswa as $m)
        @include('pages.admin.kelola.mahasiswa.D3.hapus_mahasiswaD3')
        @include('pages.admin.kelola.mahasiswa.detail')
    @endforeach
    @include('pages.admin.kelola.mahasiswa.importMhsD3')
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
        document.getElementById('push').onclick = function() {
            var idnya = [];
            var marked = document.getElementsByName('id_mhs');
            for (var checkb of marked) {
                if (checkb.checked) {
                    var id = checkb.value;
                    idnya.push(id);
                }
            }

            var confirmDialog = confirm("Apakah Anda yakin ingin menaikkan semester data mahasiswa yang dipilih?");

            if (confirmDialog) {
                $.ajax({
                    type: "POST",
                    url: '/naiksemester-mahasiswa-D3',
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
                            title: 'Gagal',
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

    <script>
        document.getElementById('deleteMhs').onclick = function() {
            var idnya = [];
            var marked = document.getElementsByName('id_mhs');
            for (var checkb of marked) {
                if (checkb.checked) {
                    var id = checkb.value;
                    idnya.push(id);
                }
            }

            var confirmDialog = confirm("Apakah Anda yakin ingin menghapus seluruh data mahasiswa yang dipilih?");

            if (confirmDialog) {
                $.ajax({
                    type: "POST",
                    url: '/checkhapus-mahasiswa-D3',
                    data: {
                        idnya: idnya,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        iziToast.success({
                            title: 'Berhasil',
                            message: 'Data mahasiswa berhasil dihapus.',
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
