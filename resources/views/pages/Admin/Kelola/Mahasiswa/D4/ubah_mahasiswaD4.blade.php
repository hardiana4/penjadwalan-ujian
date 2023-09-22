@extends('layouts.app')

@section('title', 'Ubah Mahasiswa Prodi D4')

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
                    <div class="breadcrumb-item">Ubah Mahasiswa Prodi D4</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Mahasiswa Prodi D4</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.mahasiswaD4', ['id' => $mahasiswa->id_mahasiswa]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Mahasiswa</label>
                                            <input type="text" autocomplete="off"  name="nama_mahasiswa"
                                                class="form-control @error('nama_mahasiswa') is-invalid
                                            @enderror nonAngkaInput"
                                                id="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}" autofocus="on">
                                            @error('nama_mahasiswa')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>NPM</label>
                                            <input type="text" autocomplete="off"  name="npm"
                                                class="form-control @error('npm') is-invalid
                                            @enderror"
                                                id="npm" value="{{ $mahasiswa->npm }}">
                                            @error('npm')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Prodi</label><br>
                                            <select
                                                class="form-control selectric
                                                @error('id_prodi')
                                                is-invalid
                                                @enderror"
                                                name="id_prodi" id="id_prodi" placeholder="- Pilih Prodi -"
                                                value="{{ old('prodi') }}" autofocus='true'>
                                                <option value="">- Pilih Prodi -</option>
                                                @foreach ($prodi as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $mahasiswa->id_prodi == $key ? 'selected' : '' }}>{{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_prodi')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Semester <span style="color: red;">(tidak dapat diubah)</span></label>
                                            <input type="text" autocomplete="off"  name="semester"
                                                class="form-control @error('semester') is-invalid
                                            @enderror"
                                                id="semester" value="{{ $mahasiswa->semester }}" readonly>
                                            @error('semester')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Kelas</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="A"
                                                        {{ $mahasiswa->kode_kelas == 'A' ? 'checked' : '' }}
                                                        class="selectgroup-input" checked="">
                                                    <span class="selectgroup-button">A</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="B"
                                                        {{ $mahasiswa->kode_kelas == 'B' ? 'checked' : '' }}
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">B</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="C"
                                                        {{ $mahasiswa->kode_kelas == 'C' ? 'checked' : '' }}
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">C</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kode_kelas" value="D"
                                                        {{ $mahasiswa->kode_kelas == 'D' ? 'checked' : '' }}
                                                        class="selectgroup-input">
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
                                                name="id_pengawas" id="id_pengawas" placeholder="- Pilih Prodi -">
                                                <option value="">- Pilih Dosen Wali -</option>
                                                @foreach ($pengawas as $data)
                                                    <option value="{{ $data->id_pengawas }}"
                                                        {{ $mahasiswa->id_pengawas == $data->id_pengawas ? 'selected' : '' }}>
                                                        {{ $data->detail->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_pengawas')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row float-right" style="margin: 0px 0px 25px;">
                                    <a href="{{ route('mahasiswa.D4') }}" type="button"
                                        class="btn btn-danger">Batal</a>&nbsp;
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="id_prodi"]').on('change', function() {
                var IDprodi = $(this).val();
                if (IDprodi) {
                    $.ajax({
                        url: '/dosen/' + IDprodi,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="id_users"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="id_users"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="id_users"]').empty();
                }
            });
        });
    </script>
@endpush
