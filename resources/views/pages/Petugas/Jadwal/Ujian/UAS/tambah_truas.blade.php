@extends('layouts.app')

@section('title', 'Tambah Penjadwalan UAS')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan UAS</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">UAS</div>
                    <div class="breadcrumb-item">D3</div>
                </div>
            </div>

            <div class="alert alert-danger alert-dismissible show fade alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    @foreach ($tapel as $t)
                        Tahun pelajaran saat ini adalah <strong style="color: yellow;">{{ $t->tahun_pelajaran }}</strong>.
                        Apabila belum sesuai, ubah sebelum submit form ini di <a
                            href="{{ route('tahun.pelajaran') }}"><ins>sini</ins></a>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Penjadwalan UAS</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.trUAS') }}" method="POST" enctype="multipart/form-data">
                                <div id="error-message" style="display: none; color: red;"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <label>Prodi</label><br>
                                            <select class="form-control selectric" id="id_prodi" name="id_prodi"
                                                placeholder="- Pilih Prodi -">
                                                <option value="">- Pilih Prodi -</option>
                                                @foreach ($prodi as $data)
                                                    <option value="{{ $data->id_prodi }}"> {{ $data->prodi }} </option>
                                                @endforeach
                                            </select>
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
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="VII (Tujuh)"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">7</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="semester" value="VIII (Delapan)"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">8</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Kelas</label><br>
                                            <select class="form-control selectric" name="kode_kelas" id="kode_kelas">
                                                <option value="">- Pilih Kode Kelas -</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select class="form-control select2 @error('kelas') is-invalid @enderror"
                                                name="kelas" id="kelas">
                                                <option value="">- Pilih Kelas -</option>
                                                @foreach ( $kelas as $k )
                                                <option value="{{ $k }}">{{ $k }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ruangan</label>
                                            <select
                                                class="form-control selectric @error('id_trruangan') is-invalid @enderror"
                                                name="id_trruangan" id="id_trruangan">
                                                <option value="">- Pilih Ruangan -</option>
                                            </select>
                                            @error('id_trruangan')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Ujian</label><br>
                                            <select class="form-control selectric" id="tgl_ujian" name="tgl_ujian"
                                                placeholder="- Pilih Tanggal Ujian -">
                                                <option value="">- Pilih Tanggal Ujian -</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sesi</label><br>
                                            <select class="form-control selectric" id="sesi" name="sesi"
                                                placeholder="- Pilih Sesi -">
                                                <option value="">- Pilih Sesi -</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mata kuliah</label>
                                            <select
                                                class="form-control selectric @error('id_trmatakuliah') is-invalid @enderror"
                                                id="id_trmatakuliah" name="id_trmatakuliah"
                                                placeholder="- Pilih matakuliah -">
                                                <option value="">- Pilih Mata kuliah -</option>
                                            </select>
                                            @error('id_trmatakuliah')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Pengawas 1</label><br>
                                            <select
                                                class="form-control select2
                                                @error('id_pengawas1')
                                                is-invalid
                                                @enderror"
                                                name="id_pengawas1" id="id_pengawas1">
                                                <option value="">- Pilih Pengawas 1 -</option>
                                            </select>
                                            @error('id_pengawas1')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Pengawas 2</label><br>
                                            <select
                                                class="form-control select2
                                                @error('id_pengawas2')
                                                is-invalid
                                                @enderror"
                                                name="id_pengawas2" id="id_pengawas2">
                                                <option value="">- Pilih Pengawas 2 -</option>
                                            </select>
                                            @error('id_pengawas2')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row float-right" style="margin: 0px 0px 25px;">
                                        <a href="{{ route('trUAS') }}" type="button"
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
        $('#id_pengawas1').select2;
    </script>
    <script>
        $('#kelas').select2;
    </script>
    <script>
        $(document).ready(function() {
            $('#kelas').change(function() {
            // $('#id_prodi, input[name="semester"], #kode_kelas').change(function() {
                // var id_prodi = $('#id_prodi').val();
                // var semester = $('input[name="semester"]:checked').val();
                // var kode_kelas = $('#kode_kelas').val();
                var kelas = $('#kelas').val();
                var tgl_ujian = $('#tgl_ujian').val();
                var sesi = $('#sesi').val();
                var id_pengawas1 = $('#id_pengawas1').val();

                $.ajax({
                    url: '/get-tanggal-ujian',
                    method: 'GET',
                    data: {
                        kelas: kelas,
                        // semester: semester,
                        // kode_kelas: kode_kelas,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var tgl_ujianSelect = $('#tgl_ujian');
                        var sesiSelect = $('#sesi');
                        var matakuliahSelect = $('#id_trmatakuliah');

                        // Menghapus opsi tgl_ujian sebelumnya
                        tgl_ujianSelect.empty();
                        sesiSelect.empty();
                        matakuliahSelect.empty();

                        // Menambahkan opsi tgl_ujian baru berdasarkan respons dari server
                        var opsi = $('<option>- Pilih Tanggal Ujian -</option>');
                        tgl_ujianSelect.append(opsi);
                        if (response && response.length > 0) {
                            $.each(response, function(index, value) {
                                var option = $('<option></option>').attr('value', value)
                                    .text(value);
                                tgl_ujianSelect.append(option);
                            });
                        } else {
                            // Jika tidak ada data tgl_ujian, kosongkan nilai dan tampilkan pesan
                            tgl_ujianSelect.append($('<option></option>').attr('disabled', true)
                                .text('Data tanggal ujian tidak ditemukan.'));

                            var opsiSesi = $('<option>- Pilih Sesi -</option>');
                            sesiSelect.append(opsiSesi);
                            sesiSelect.append($('<option></option>').attr('disabled', true)
                                .text('Data sesi tidak ditemukan.'));

                            var opsiMatakuliah = $('<option>- Pilih Matakuliah -</option>');
                            matakuliahSelect.append(opsiMatakuliah);
                            matakuliahSelect.append($('<option></option>').attr(
                                    'disabled', true)
                                .text('Data matakuliah tidak ditemukan.'));
                        }

                        // Memperbarui tampilan elemen selectric/select2 setelah append
                        tgl_ujianSelect.selectric();
                        sesiSelect.selectric();
                        matakuliahSelect.selectric();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                // $.ajax({
                //     url: '/get-kelas-ujian',
                //     method: 'GET',
                //     data: {
                //         id_prodi: id_prodi,
                //         semester: semester,
                //         kode_kelas: kode_kelas,
                //         _token: '{{ csrf_token() }}'
                //     },
                //     success: function(response) {
                //         var kelasSelect = $('#kelas');
                //         var ruanganSelect = $('#id_trruangan');

                //         // Menghapus opsi kelas sebelumnya
                //         kelasSelect.empty();
                //         ruanganSelect.empty();

                //         // Menambahkan opsi kelas baru berdasarkan respons dari server
                //         var opsi = $('<option>- Pilih Kelas -</option>');
                //         kelasSelect.append(opsi);
                //         if (response && response.length > 0) {
                //             $.each(response, function(index, value) {
                //                 var option = $('<option></option>').attr('value', value)
                //                     .text(value);
                //                 kelasSelect.append(option);
                //             });
                //         } else {
                //             // Jika tidak ada data kelas, kosongkan nilai dan tampilkan pesan
                //             kelasSelect.append($('<option></option>').attr('disabled', true)
                //                 .text('Data kelas tidak ditemukan.'));

                //             var opsiRuangan = $('<option>- Pilih Ruangan -</option>');
                //             ruanganSelect.append(opsiRuangan);
                //             ruanganSelect.append($('<option></option>').attr('disabled', true)
                //                 .text('Data ruangan tidak ditemukan.'));
                //         }

                //         // Memperbarui tampilan elemen selectric/select2 setelah append
                //         kelasSelect.selectric();
                //         ruanganSelect.selectric();
                //     },
                //     error: function(xhr, status, error) {
                //         console.error(xhr.responseText);
                //     }
                // });
            });

            // Handler untuk perubahan tgl_ujian
            $('#kelas').change(function() {
                var kelas = $('#kelas').val();

                // Membuat AJAX request untuk mendapatkan opsi matakuliah berdasarkan tgl_ujian dan sesi yang dipilih
                $.ajax({
                    url: '/get-ruangan-ujian',
                    method: 'GET',
                    data: {
                        kelas: kelas,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(ruanganResponse) {
                        var ruanganSelect = $('#id_trruangan');

                        // Menghapus opsi ruangan sebelumnya
                        ruanganSelect.empty();

                        var opsi = $('<option>- Pilih Ruangan -</option>');
                        ruanganSelect.append(opsi);
                        // Menambahkan opsi ruangan baru berdasarkan respons dari server
                        if (ruanganResponse && ruanganResponse.length > 0) {
                            $.each(ruanganResponse, function(index, ruanganData) {
                                var option = $('<option></option>').attr('value',
                                    ruanganData['tr_ruangan.id_trruangan']).text(
                                    ruanganData['ruangan.ruangan']);
                                ruanganSelect.append(option);
                            });
                        } else {
                            // Jika tidak ada data ruangan, kosongkan nilai dan tampilkan pesan
                            ruanganSelect.append($('<option></option>').attr('disabled', true)
                                .text('Data ruangan tidak ditemukan.'));
                        }

                        // Memperbarui tampilan elemen selectric/select2 setelah append
                        ruanganSelect.selectric();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Handler untuk perubahan tgl_ujian
            $('#tgl_ujian').change(function() {
                // var id_prodi = $('#id_prodi').val();
                // var semester = $('input[name="semester"]:checked').val();
                // var kode_kelas = $('#kode_kelas').val();
                var kelas = $('#kelas').val();
                var tgl_ujian = $('#tgl_ujian').val();

                // Membuat AJAX request untuk mendapatkan opsi matakuliah berdasarkan tgl_ujian dan sesi yang dipilih
                $.ajax({
                    url: '/get-sesi-ujian',
                    method: 'GET',
                    data: {
                        // id_prodi: id_prodi,
                        // semester: semester,
                        // kode_kelas: kode_kelas,
                        kelas: kelas,
                        tgl_ujian: tgl_ujian,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(sesiResponse) {
                        var sesiSelect = $('#sesi');
                        var matakuliahSelect = $('#id_trmatakuliah');

                        // Menghapus opsi sesi sebelumnya
                        sesiSelect.empty();
                        matakuliahSelect.empty();

                        var opsi = $('<option>- Pilih Sesi -</option>');
                        sesiSelect.append(opsi);
                        // Menambahkan opsi sesi baru berdasarkan respons dari server
                        if (sesiResponse && sesiResponse.length > 0) {
                            $.each(sesiResponse, function(index, value) {
                                var option = $('<option></option>').attr('value', value.id_sesi).text(value.sesi.sesi);
                                sesiSelect.append(option);
                            });
                        } else {
                            // Jika tidak ada data sesi, kosongkan nilai dan tampilkan pesan
                            sesiSelect.append($('<option></option>').attr(
                                    'disabled', true)
                                .text('Data sesi tidak ditemukan.'));
                        }

                        // Memperbarui tampilan elemen selectric/select2 setelah append
                        sesiSelect.selectric();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                // Handler untuk perubahan sesi
                $.ajax({
                    url: '/get-trmatakuliah-ujian',
                    method: 'GET',
                    success: function(trmatkulResponse) {
                        var trmatkulIds = trmatkulResponse;

                        // Event handler saat tgl_ujian atau sesi berubah
                        $('#tgl_ujian, #sesi').change(function() {
                            // var id_prodi = $('#id_prodi').val();
                            // var semester = $('input[name="semester"]:checked').val();
                            var kelas = $('#kelas').val();
                            var tgl_ujian = $('#tgl_ujian').val();
                            var sesi = $('#sesi').val();

                            // Mengambil data matakuliah dari /get-matakuliah-ujian
                            $.ajax({
                                url: '/get-matakuliah-ujian',
                                method: 'GET',
                                data: {
                                    // id_prodi: id_prodi,
                                    // semester: semester,
                                    // kode_kelas: kode_kelas,
                                    kelas: kelas,
                                    tgl_ujian: tgl_ujian,
                                    sesi: sesi,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(matakuliahResponse) {
                                    var matakuliahSelect = $('#id_trmatakuliah');

                                    // Menghapus opsi matakuliah sebelumnya
                                    matakuliahSelect.empty();
                                    var opsiMatakuliah = $('<option>- Pilih Matakuliah -</option>');
                                    matakuliahSelect.append(opsiMatakuliah);

                                    if (matakuliahResponse && matakuliahResponse.length > 0) {
                                        $.each(matakuliahResponse, function(index, value) {
                                            var option = $('<option></option>')
                                                .attr('value', value.id_trmatakuliah)
                                                .text(value.matkul.matakuliah);

                                            if (trmatkulIds.includes(value.id_trmatakuliah)) {
                                                option.text(value.matkul.matakuliah + ' (Matakuliah sudah dijadwalkan)');
                                                option.attr('disabled', true);
                                            }

                                            matakuliahSelect.append(option);
                                        });
                                    } else {
                                        matakuliahSelect.append($('<option></option>')
                                            .attr('disabled', true)
                                            .text('Data matakuliah tidak ditemukan.'));
                                    }

                                    // Memperbarui tampilan elemen selectric/select2 setelah append
                                    matakuliahSelect.selectric();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#id_trmatakuliah').change(function() {
                var sesi = $('#sesi').val();
                var tgl_ujian = $('#tgl_ujian').val();
                var id_trmatakuliah = $('#id_trmatakuliah').val();
                $.ajax({
                    url: '/get-pengawas1-ujian',
                    method: 'GET',
                    data: {
                        sesi: sesi,
                        tgl_ujian: tgl_ujian,
                        id_trmatakuliah: id_trmatakuliah,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var Pengawas1Select = $('#id_pengawas1');

                        Pengawas1Select.empty();

                        var opsiPengawas1 = $(
                            '<option>- Pilih Pengawas 1 -</option>');
                        Pengawas1Select.append(opsiPengawas1);

                        if (response && response.length > 0) {
                            $.each(response, function(index, pengawasData) {
                                var option = $('<option>').val(pengawasData
                                    .id_pengawas).text(
                                    pengawasData.detail.nama);
                                Pengawas1Select.append(option);
                            });
                        } else {
                            Pengawas1Select.append($('<option></option>').att8ir(
                                    'disabled', true)
                                .text('Data pengawas 1 tidak ditemukan.'));
                        }

                        Pengawas1Select.select2();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Menambahkan perubahan event handler pada Pengawas1Select
            $('#id_pengawas1').change(function() {
                var sesi = $('#sesi').val();
                var tgl_ujian = $('#tgl_ujian').val();
                var id_pengawas1 = $('#id_pengawas1').val();
                var id_trmatakuliah = $('#id_trmatakuliah').val();
                $.ajax({
                    url: '/get-pengawas2-ujian',
                    method: 'GET',
                    data: {
                        sesi: sesi,
                        tgl_ujian: tgl_ujian,
                        id_pengawas1: id_pengawas1,
                        id_trmatakuliah: id_trmatakuliah,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var Pengawas2Select = $('#id_pengawas2');

                        Pengawas2Select.empty();
                        var opsiPengawas2 = $(
                            '<option>- Pilih Pengawas 2 -</option>');
                        Pengawas2Select.append(opsiPengawas2);

                        if (response && response.length > 0) {
                            $.each(response, function(index,
                                pengawasData) {
                                var option = $('<option>').val(
                                    pengawasData.id_pengawas).text(pengawasData.detail.nama);
                                Pengawas2Select.append(option);
                            });
                        } else {
                            Pengawas2Select.append($(
                                '<option></option>').attr(
                                'disabled', true).text(
                                'Data pengawas 2 tidak ditemukan.'
                            ));
                        }
                        Pengawas2Select.select2();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
