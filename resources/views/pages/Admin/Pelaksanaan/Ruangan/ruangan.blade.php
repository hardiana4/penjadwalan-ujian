@extends('layouts.app')

@section('title', 'Ruangan')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ruangan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Ruangan</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Ruangan</h4>
                            <div class="col box-header text-right">
                                <a href="" class="btn btn-success" data-toggle="modal" data-target="#importExcel"><i
                                        class="fa fa-file-import"></i &nbsp> Import Excel</a>
                                <a href="{{ route('ruangan') }}" id="deleteRuangan" class="btn btn-danger dis disabled"><i
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
                                            <th>Gedung</th>
                                            <th>Ruangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($ruangan as $r)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="check"
                                                                value="{{ $r->id_ruangan }}" name="id_ruangan" id="test-cb">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $r->gedung->singkat }}</td>
                                                <td>{{ $r->ruangan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card" style="position: sticky; top: 10px;">
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
                                                <option value="{{ $data->id_gedung }}"
                                                    {{ old('id_gedung') == $data->id_gedung ? 'selected' : '' }}>
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.admin.pelaksanaan.ruangan.importRuangan')
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
        document.getElementById('deleteRuangan').onclick = function() {
            var idnya = [];
            var marked = document.getElementsByName('id_ruangan');
            for (var checkb of marked) {
                if (checkb.checked) {
                    var id = checkb.value;
                    idnya.push(id);
                }
            }

            var confirmDialog = confirm("Apakah Anda yakin ingin menghapus seluruh data ruangan yang dipilih?");

            if (confirmDialog) {
                $.ajax({
                    type: "POST",
                    url: '/checkhapus-ruangan',
                    data: {
                        idnya: idnya,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        iziToast.success({
                            title: 'Berhasil',
                            message: 'Data ruangan berhasil dihapus.',
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
