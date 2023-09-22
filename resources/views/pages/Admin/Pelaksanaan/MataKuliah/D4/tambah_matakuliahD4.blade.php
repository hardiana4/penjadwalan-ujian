@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah Prodi D4')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mata Kuliah Prodi D4</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/matakuliah-D4') }}">Mata Kuliah Prodi D4</a></div>
                    <div class="breadcrumb-item">Tambah Mata Kuliah Prodi D4</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Mata Kuliah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.matakuliahD4') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        @csrf
                                        <div class="form-group">
                                            <label>Prodi</label><br>
                                            <select class="form-control selectric @error('id_prodi') is-invalid @enderror"
                                                name="id_prodi" id="id_prodi" placeholder="- Pilih Prodi -"
                                                value="{{ old('prodi') }}">
                                                <option value="">- Pilih Prodi -</option>
                                                @foreach ($prodi as $data)
                                                    <option value="{{ $data->id_prodi }}"
                                                        {{ old('id_prodi') == $data->id_prodi ? 'selected' : '' }}>
                                                        {{ $data->prodi }}
                                                    </option>
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
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Matakuliah</th>
                                                            <th class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="rownumber text-center" width="5%">1</td>
                                                            <td><input type="text" autocomplete="off"  name="matakuliah[]"
                                                                    placeholder="Masukan nama mata kuliah"
                                                                    class="form-control @error('matakuliah[]') is-invalid @enderror nonAngkaInput">
                                                                @error('matakuliah[]')
                                                                    <div class='invalid-feedback'>
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </td>
                                                            <td width="5%"><button type="button"
                                                                    name="tambah_matakuliah" id="tambah_matakuliah"
                                                                    class="btn btn-success" onClick="onClick()"><i
                                                                        class="fa-solid fa-plus"></i></button></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @error('npm[]')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </td>
                                        </div>

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
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        var i = 0;
        $('#tambah_matakuliah').click(function() {
            i++;
            var newRow = $('<tr>' +
                '<td class="rownumber text-center" width="2%"></td>' +
                '<td><input type="text" autocomplete="off" name="matakuliah[]" placeholder="Masukan nama mata kuliah" class="form-control nonAngkaInput"></td>' +
                '<td width="5%"><button type="button" class="btn btn-danger remove-table-row"><i class="fa-solid fa-minus"></i></button></td>' +
                '</tr>');

            $('.card-body .table tbody').append(newRow);
            renumberRows();

            addListenersToNewRow(newRow);
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
            renumberRows();
        });

        function renumberRows() {
            $(".card-body .table tbody > tr").each(function(i, v) {
                $(this).find(".rownumber").text(i + 1);
            });
        }

        function addListenersToNewRow(newRow) {
            newRow.find('.nonAngkaInput').on('input', function(event) {
                var cleanedValue = event.target.value.replace(/\d/g, '');
                if (cleanedValue !== event.target.value) {
                    event.target.value = cleanedValue;
                }
            });
        }
    </script>
@endpush
