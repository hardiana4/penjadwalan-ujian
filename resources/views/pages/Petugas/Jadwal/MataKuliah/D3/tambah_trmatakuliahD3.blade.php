@extends('layouts.app')

@section('title', 'Tambah Penjadwalan Mata Kuliah Prodi D3')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan Mata Kuliah Prodi D3</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/penjadwalan-matakuliah-D3') }}">Penjadwalan Mata Kuliah
                            Prodi D3</a></div>
                    <div class="breadcrumb-item">Tambah</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Penjadwalan Mata Kuliah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.trmatakuliahD3') }}" method="POST"
                                enctype="multipart/form-data">
                                <div id="error-message" style="display: none; color: red;"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Prodi</label><br>
                                                    <select class="form-control selectric @error('id_prodi') is-invalid @enderror"
                                                        id="id_prodi" name="id_prodi" placeholder="- Pilih Prodi -">
                                                        <option value="">- Pilih Prodi -</option>
                                                        @foreach ($prodi as $data)
                                                            <option value="{{ $data->id_prodi }}"> {{ $data->prodi }} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_prodi')
                                                        <div class='invalid-feedback d-block'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Semester</label>
                                                    <div class="selectgroup w-100">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="semester" value="I (Satu)"
                                                                class="selectgroup-input" checked="">
                                                            <span class="selectgroup-button">1</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="semester" value="II (Dua)"
                                                                class="selectgroup-input">
                                                            <span class="selectgroup-button">2</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="semester" value="III (Tiga)"
                                                                class="selectgroup-input">
                                                            <span class="selectgroup-button">3</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="semester" value="IV (Empat)"
                                                                class="selectgroup-input">
                                                            <span class="selectgroup-button">4</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="semester" value="V (Lima)"
                                                                class="selectgroup-input">
                                                            <span class="selectgroup-button">5</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="semester" value="VI (Enam)"
                                                                class="selectgroup-input">
                                                            <span class="selectgroup-button">6</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Kelas</label>
                                                    <select class="form-control select2 @error('kode_kelas') is-invalid @enderror"
                                                        multiple="" placeholder="- Pilih 1 atau lebih -" name="kode_kelas[]"
                                                        id="kode_kelas">
                                                        <option disabled>- Pilih 1 atau lebih -</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                    </select>
                                                    @error('kode_kelas')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mata kuliah</label><br>
                                                    <select
                                                        class="form-control selectric @error('id_matakuliah') is-invalid @enderror"
                                                        name="id_matakuliah" id="matakuliah">
                                                        <option value="">- Pilih Mata kuliah -</option>
                                                    </select>
                                                    @error('id_matakuliah')
                                                        <div class='invalid-feedback d-block'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Dosen Pengampu</label><br>
                                                    <select
                                                        class="form-control select2
                                                        @error('id_pengawas')
                                                        is-invalid
                                                        @enderror"
                                                        name="id_pengawas" id="id_pengawas">
                                                        <option value="">- Pilih Dosen Pengampu -</option>
                                                        @foreach ($pengampu as $data)
                                                            <option value="{{ $data->id_pengawas }}"> {{ $data->detail->nama }} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_pengawas')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tanggal Ujian</label>
                                                    <input type="text"
                                                        class="form-control @error('tgl_ujian')
                                                        is-invalid
                                                        @enderror"
                                                        id="tgl_ujian" name="tgl_ujian" placeholder="Tanggal Bulan Tahun">
                                                    @error('tgl_ujian')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Sesi</label><br>
                                                    <select class="form-control selectric @error('id_sesi') is-invalid @enderror"
                                                        name="id_sesi" id="id_sesi" placeholder="- Pilih Sesi -">
                                                        <option value="">- Pilih Sesi -</option>
                                                        @foreach ($sesi as $data)
                                                            <option value="{{ $data->id_sesi }}"
                                                                {{ old('id_sesi') == $data->id_sesi ? 'selected' : '' }}>
                                                                {{ $data->sesi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_sesi')
                                                        <div class='invalid-feedback d-block'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row float-right" style="margin: 0px 0px 25px;">
                                        <a href="{{ route('trmatakuliahD3') }}" type="button"
                                            class="btn btn-danger">Batal</a>&nbsp;
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_prodi, input[name="semester"]').change(function() {
                var id_prodi = $('#id_prodi').val();
                var semester = $('input[name="semester"]:checked').val();

                $.ajax({
                    url: '/get-matkul',
                    method: 'GET',
                    data: {
                        id_prodi: id_prodi,
                        semester: semester,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var matakuliahSelect = $('#matakuliah');

                        // Menghapus opsi matakuliah sebelumnya
                        matakuliahSelect.empty();
                        // Menambahkan opsi matakuliah baru berdasarkan respons dari server
                        $.each(response, function(key, value) {
                            var option = $('<option></option>').attr('value', value
                                .id_matakuliah).text(value.matakuliah);
                            matakuliahSelect.append(option);
                        });

                        // Memperbarui tampilan elemen selectric/select2 setelah append
                        matakuliahSelect.selectric();
                        // matakuliahSelect.select2();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        var i = 0;
        $('#tambah_matakuliah').click(function() {
            i++;
            $(document).find('.card-body .table tbody').append(
                '<tr><td class="rownumber text-center" width="2%"></td><td><input type="text" name="matakuliah[]" placeholder="Masukan nama matakuliah" class="form-control"></td><td width="5%"><button type="button" class="btn btn-danger remove-table-row"><i class="fa-solid fa-minus"></i></button></td></tr>'
            );
            renumberRows();
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
        });

        function renumberRows() {
            $(".card-body .table tbody > tr").each(function(i, v) {
                $(this).find(".rownumber", "counter").text(i + 1);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        flatpickr("#tgl_ujian", {
            dateFormat: "j F Y",
            locale: "id",
        });
    </script>
@endpush
