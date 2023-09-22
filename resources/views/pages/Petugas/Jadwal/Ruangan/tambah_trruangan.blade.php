@extends('layouts.app')

@section('title', 'Tambah Penjadwalan Ruangan')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan Ruangan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Penjadwalan Ruangan</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.trruangan') }}" method="POST" enctype="multipart/form-data">
                                <div id="error-message" style="display: none; color: red;"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @csrf
                                        <div class="form-group">
                                            <label>Kelas</label><br>
                                            <select id="kelas"
                                                class="form-control select2 @error('kelas') is-invalid @enderror"
                                                name="kelas" placeholder="- Pilih Kelas -">
                                                <option value="">- Pilih Kelas -</option>
                                            </select>
                                            @error('id_prodi')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Ruangan</label><br>
                                            <select id="id_ruangan"
                                                class="form-control select2 @error('id_ruangan') is-invalid @enderror"
                                                name="id_ruangan">
                                                <option value="">- Pilih Ruangan -</option>
                                            </select>
                                            @error('id_ruangan')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row float-right" style="margin: 0px 0px 25px;">
                                        <a href="{{ route('trruangan') }}" type="button"
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
        @if (session()->has('success'))
            iziToast.success({
                title: "Berhasil",
                message: "{{ session('success') }}",
                position: "topRight"
            });
        @endif
        @if (session()->has('errors'))
            iziToast.error({
                title: "Gagal",
                message: "Data sudah pernah diinput. Silakan cek kembali!",
                position: "topRight"
            });
        @endif
    </script>
    <script>
        const kelasSelect = document.getElementById('kelas');

        // Ambil opsi kelas dari tabel tr_matakuliah yang belum ada di tabel tr_ruangan
        fetch('/get-kelas')
            .then(response => response.json())
            .then(data => {
                // Ambil kelas yang sudah ada di tabel tr_ruangan
                fetch('/get-tr-ruangan-kelas')
                    .then(response => response.json())
                    .then(trRuanganData => {
                        const trRuanganKelas = trRuanganData;

                        // Filter kelas yang belum ada di tabel tr_ruangan
                        const availableKelas = data.filter(kelas => !trRuanganKelas.includes(kelas));

                        // Menghapus semua opsi kelas sebelumnya
                        kelasSelect.innerHTML = '';
                        const opsi = document.createElement('option');
                        opsi.value = '';
                        opsi.text = '- Pilih Kelas -';
                        kelasSelect.appendChild(opsi);

                        if (availableKelas.length > 0) {
                            availableKelas.forEach(kelas => {
                                const option = document.createElement('option');
                                option.value = kelas;
                                option.text = kelas;
                                kelasSelect.appendChild(option);
                            });
                        } else {
                            const option = document.createElement('option');
                            option.value = '';
                            option.text = 'Data tidak ditemukan';
                            option.disabled = true;
                            kelasSelect.appendChild(option);
                        }

                        // Inisiasi Select2 pada elemen kelasSelect
                        $(kelasSelect).select2();
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
    </script>
    <script>
        $(document).ready(function() {
            $('#kelas').change(function() {
                var kelas = $('#kelas').val();

                $.ajax({
                    url: '/get-ruangan',
                    method: 'GET',
                    data: {
                        kelas: kelas,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var RuanganSelect = $('#id_ruangan');

                        // Menghapus opsi ruangan sebelumnya
                        RuanganSelect.empty();
                        var opsi = $('<option>- Pilih Ruangan -</option>');
                        RuanganSelect.append(opsi);

                        // Menambahkan opsi ruangan baru berdasarkan respons dari server
                        if (response && response.length > 0) {
                            $.each(response, function(key, value) {
                                var option = $('<option></option>').attr('value', value.id).text(value.ruangan);
                                RuanganSelect.append(option);
                            });
                        } else {
                            // Jika tidak ada data ruangan, kosongkan nilai dan tampilkan pesan
                            var option = $('<option></option>').attr('disabled', true)
                                .text('Data ruangan tidak ditemukan.');
                            RuanganSelect.append(option);
                        }

                        // Memperbarui tampilan elemen selectric/select2 setelah append
                        RuanganSelect.select2();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
