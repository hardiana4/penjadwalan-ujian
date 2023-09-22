@extends('layouts.app')

@section('title', 'Tambah Sesi')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Sesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('/sesi') }}">Sesi</a></div>
                    <div class="breadcrumb-item">Tambah Sesi</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Sesi</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.sesi') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Urutan Sesi</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="urutan" value="1"
                                                class="selectgroup-input"checked="">
                                            <span class="selectgroup-button">1</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="urutan" value="2" class="selectgroup-input">
                                            <span class="selectgroup-button">2</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="urutan" value="3" class="selectgroup-input">
                                            <span class="selectgroup-button">3</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="urutan" value="4" class="selectgroup-input">
                                            <span class="selectgroup-button">4</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_awal" class="form-label">Waktu Mulai</label>
                                    <input type="text" autocomplete="off"  class="form-control @error('waktu_awal') is-invalid @enderror"
                                        id="waktu" name="waktu_awal" value="{{ old('waktu_awal') }}"
                                        placeholder="- Pilih Waktu Mulai -" required>
                                    @error('waktu_awal')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="waktu_akhir" class="form-label">Waktu Selesai</label>
                                    <input type="text" autocomplete="off"  class="form-control @error('waktu_akhir') is-invalid @enderror"
                                        id="waktu" name="waktu_akhir" value="{{ old('waktu_akhir') }}"
                                        placeholder="- Pilih Waktu Selesai -" required>
                                    @error('waktu_akhir')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <div class="row float-right" style="margin: 0px 0px 25px;">
                                        <a href="{{ url('/sesi') }}" type="button" class="btn btn-danger">Batal</a>&nbsp;
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        flatpickr("#waktu", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H.i",
            time_24hr: true,
            minTime: "07.30",
            maxTime: "16.00",
            locale: "id" // Menggunakan lokal bahasa Indonesia
        });
    </script>
@endpush
