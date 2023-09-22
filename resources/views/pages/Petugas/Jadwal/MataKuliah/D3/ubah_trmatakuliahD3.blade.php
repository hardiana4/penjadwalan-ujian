@extends('layouts.app')

@section('title', ' Ubah Matakuliah Prodi D3')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan Matakuliah Prodi D3</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/penjadwalan-matakuliah-D3') }}">Penjadwalan Matakuliah Prodi D3</a></div>
                    <div class="breadcrumb-item">Ubah</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Penjadwalan Matakuliah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.trmatakuliahD3', ['id' => $tr_matakuliah->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Kelas</label><br>
                                    <input type="text" autocomplete="off"  name="kelas" class="form-control" id="kelas"
                                        value="{{ $tr_matakuliah->kelas }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Matakuliah</label>
                                    <input type="text" autocomplete="off"  name="id_matakuliah" class="form-control" id="matakuliah"
                                        value="{{ $tr_matakuliah->matkul->matakuliah ?? ''}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Dosen Pengampu</label><br>
                                    <select
                                        class="form-control select2
                                        @error('id_pengawas')
                                        is-invalid
                                        @enderror"
                                        name="id_pengawas" id="id_pengawas" placeholder="- Pilih Prodi -">
                                        <option value="">- Pilih Dosen Pengampu -</option>
                                        @foreach ($pengampu as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $tr_matakuliah->id_pengawas == $data->id ? 'selected' : '' }}>
                                                {{ $data->detail->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pengawas')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Ujian</label>
                                    <input type="text" autocomplete="off"  class="form-control @error('tgl_ujian') is-invalid @enderror"
                                        id="tgl_ujian" name="tgl_ujian" value="{{ $tr_matakuliah->tgl_ujian }}">
                                    @error('tgl_ujian')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Sesi</label><br>
                                    <select
                                        class="form-control selectric @error('id_sesi') is-invalid @enderror"
                                        name="id_sesi" id="id_sesi" placeholder="- Pilih Sesi -">
                                        <option value="">- Pilih Sesi -</option>
                                        @foreach ($sesi as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $tr_matakuliah->id_sesi == $data->id ? 'selected' : '' }}>
                                                {{ $data->sesi }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_sesi')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
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
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        flatpickr("#tgl_ujian", {
            dateFormat: "j F Y",
            locale: "id",
        });
    </script>
@endpush
