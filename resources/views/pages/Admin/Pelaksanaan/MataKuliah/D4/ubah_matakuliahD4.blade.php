@extends('layouts.app')

@section('title', 'Ubah Mata Kuliah Prodi D4')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Mata Kuliah Prodi D4</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/matakuliah-D4') }}">Mata Kuliah Prodi D4</a></div>
                    <div class="breadcrumb-item">Ubah Mata Kuliah Prodi D4</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Mata Kuliah Prodi D4</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.matakuliahD4', ['id' => $matakuliah->id_matakuliah]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
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
                                                {{ $matakuliah->id_prodi == $key ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_prodi')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="I (Satu)" {{($matakuliah->semester == 'I (Satu)')? 'checked': ''; }} class="selectgroup-input"
                                                checked="">
                                            <span class="selectgroup-button">1</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="II (Dua)" {{($matakuliah->semester == 'II (Dua)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">2</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="III (Tiga)" {{($matakuliah->semester == 'III (Tiga)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">3</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="IV (Empat)" {{($matakuliah->semester == 'IV (Empat)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">4</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="V (Lima)" {{($matakuliah->semester == 'V (Lima)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">5</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="VI (Enam)" {{($matakuliah->semester == 'VI (Enam)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">6</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="VII (Tujuh)" {{($matakuliah->semester == 'VII (Tujuh)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">7</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="semester" value="VIII (Delapan)" {{($matakuliah->semester == 'VIII (Delapan)')? 'checked': ''; }}
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">8</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Matakuliah</label>
                                    <input type="text" autocomplete="off"  name="matakuliah" placeholder="Masukan nama mata kuliah"
                                        class="form-control @error('matakuliah') is-invalid @enderror nonAngkaInput"
                                        value=" {{ $matakuliah->matakuliah }}">
                                    @error('matakuliah')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <a href="{{ route('matakuliah.D4') }}" type="button"
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
@endpush
