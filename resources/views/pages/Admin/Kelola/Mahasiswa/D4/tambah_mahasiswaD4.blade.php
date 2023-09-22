@extends('layouts.app')

@section('title', 'Tambah Mahasiswa Prodi D4')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mahasiswa Prodi D4</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/mahasiswa-D4') }}">Mahasiswa Prodi D4</a></div>
                    <div class="breadcrumb-item">Tambah Mahasiswa Prodi D4</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Mahasiswa Prodi D4</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.mahasiswaD4') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        @csrf
                                        <div class="form-group">
                                            <label for="id_prodi">Prodi</label><br>
                                            <div class="selectric-wrapper">
                                                <select
                                                    class="form-control @error('id_prodi') is-invalid @enderror selectric"
                                                    name="id_prodi" id="id_prodi" placeholder="- Pilih Prodi -">
                                                    <option value="">- Pilih Prodi -</option>
                                                    @foreach ($prodi as $dtProdi)
                                                         <option value="{{ $dtProdi->id_prodi }}"
                                                            {{ old('id_prodi') == $dtProdi->id_prodi ? 'selected' : '' }}>
                                                            {{ $dtProdi->prodi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('id_prodi')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="I (Satu)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'I (Satu)' ? 'checked' : '' }} checked="">
                                                    <span class="selectgroup-button">1</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="II (Dua)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'II (Dua)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">2</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="III (Tiga)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'III (Tiga)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">3</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="IV (Empat)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'IV (Empat)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">4</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="V (Lima)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'V (Lima)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">5</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="VI (Enam)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'VI (Enam)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">6</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="VII (Tujuh)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'VII (Tujuh)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">7</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="VIII (Delapan)"
                                                        class="selectgroup-input"
                                                        {{ old('semester') == 'VIII (Delapan)' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">8</span>
                                                </label>
                                            </div>
                                            @error('semester')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Kode Kelas</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="A"
                                                        class="selectgroup-input"
                                                        {{ old('kode_kelas') == 'A' ? 'checked' : '' }} checked="">
                                                    <span class="selectgroup-button">A</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="B"
                                                        class="selectgroup-input"
                                                        {{ old('kode_kelas') == 'B' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">B</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="C"
                                                        class="selectgroup-input"
                                                        {{ old('kode_kelas') == 'C' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">C</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="D"
                                                        class="selectgroup-input"
                                                        {{ old('kode_kelas') == 'D' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">D</span>
                                                </label>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Dosen Wali</label><br>
                                            <select
                                                class="form-control select2
                                                @error('id_pengawas')
                                                is-invalid
                                                @enderror"
                                                name="id_pengawas" id="id_pengawas">
                                                <option value="">- Pilih Dosen Wali -</option>
                                                @foreach ($dosen as $dtDosen)
                                                        <option value="{{ $dtDosen->id_pengawas }}"
                                                {{ old('id_pengawas') == $dtDosen->id_pengawas ? 'selected' : '' }}>
                                                {{ $dtDosen->detail->nama }}
                                                </option>
                                                    @endforeach
                                            </select>
                                            @error('id_pengawas')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="row align-items-center">
                                                <label>Data Mahasiswa</label>
                                                <div style="margin-left: auto;">
                                                    <span class="badge badge-primary rowcount-span"></span>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Nama</th>
                                                            <th class="text-center">NPM</th>
                                                            <th class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="rownumber text-center" width="2%">1</td>
                                                            <td width="50%">
                                                                <input type="text" autocomplete="off"  name="nama_mahasiswa[]"
                                                                    placeholder="Masukan nama"
                                                                    class="form-control @error('nama_mahasiswa.0') is-invalid @enderror nonAngkaInput"
                                                                    value="{{ old('nama_mahasiswa.0') }}">
                                                                @error('nama_mahasiswa.0')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </td>
                                                            <td width="43%">
                                                                <input type="number" name="npm[]"
                                                                    placeholder="Masukan NPM"
                                                                    class="form-control @error('npm.0') is-invalid @enderror"
                                                                    value="{{ old('npm.0') }}">
                                                                @error('npm.0')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </td>
                                                            <td width="5%"><button type="button"
                                                                    name="tambah_mahasiswa" id="tambah_mahasiswa"
                                                                    class="btn btn-success" onClick="onClick()"><i
                                                                        class="fa-solid fa-plus"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </td>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <a href="{{ route('mahasiswa.D4') }}" type="button"
                                    class="btn btn-danger">Batal</a>&nbsp;
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
    function addListenersToNewRow(newRow) {
        newRow.find('.nonAngkaInput').on('input', function(event) {
            var cleanedValue = event.target.value.replace(/\d/g, '');
            if (cleanedValue !== event.target.value) {
                event.target.value = cleanedValue;
            }
        });

        newRow.find('.remove-table-row').on('click', function() {
            $(this).parents('tr').remove();
            renumberRows();
            updateRowCountSpan();
        });
    }

    $(document).ready(function() {
        $('#tambah_mahasiswa').click(function() {
            var newRow = $('<tr>' +
                '<td class="rownumber" width="2%"></td>' +
                '<td width="50%">' +
                '<input type="text" autocomplete="off"  name="nama_mahasiswa[]" placeholder="Masukan nama" class="form-control nonAngkaInput" value="{{ old('nama_mahasiswa.+$no+') }}">' +
                '</td>' +
                '<td width="43%">' +
                '<input type="number" name="npm[]" placeholder="Masukan NPM" class="form-control "value="{{ old('npm.+$no+') }}">' +
                '</td>' +
                '<td width="5%">' +
                '<button type="button" class="btn btn-danger remove-table-row"><i class="fa-solid fa-minus"></i></button>' +
                '</td>' +
                '</tr>');

            $('.card-body .table tbody').append(newRow);
            addListenersToNewRow(newRow);

            renumberRows();
            updateRowCountSpan();
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
            renumberRows();
            updateRowCountSpan();
        });

        function renumberRows() {
            $(".card-body .table tbody > tr").each(function(i, v) {
                $(this).find(".rownumber").text(i + 1);
            });
        }

        function updateRowCountSpan() {
            var rowCount = $(".card-body .table tbody tr").length;
            $(".rowcount-span").text(rowCount);
        }
    });
</script>
@endpush
