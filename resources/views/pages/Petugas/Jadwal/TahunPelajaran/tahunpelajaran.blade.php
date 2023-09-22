@extends('layouts.app')

@section('title', 'Tahun Pelajaran')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tahun Pelajaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Tahun Pelajaran</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Tahun Pelajaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Tahun Pelajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $tahunpelajaran->tahun_pelajaran }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Tahun Pelajaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="container-sm container-md">
                                <form action="{{ route('update.tapel', ['id' => $tahunpelajaran->id_tp])}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahun_awal">Tahun Awal Pelajaran</label>
                                        <select name="tahun_awal"
                                            class="form-control selectric @error('tahun_awal')
                                              is-invalid
                                              @enderror">
                                            <option>- Pilih Awal Pelajaran -</option>
                                            <?php for ($i = date('Y'); $i >= date('Y') - 1; $i -= 1) {?>
                                            <option value='{{ $i }}'
                                                {{ $tahunpelajaran->tahun_awal == $i ? 'selected' : '' }}>
                                                {{ $i }} </option>";
                                            <?php } ?>
                                        </select>
                                        @error('tahun_awal')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_akhir">Tahun Akhir Pelajaran</label>
                                        <select name="tahun_akhir"
                                            class="form-control selectric @error('tahun_akhir')
                                              is-invalid
                                              @enderror">
                                            <option>- Pilih Tahun Akhir Pelajaran -</option>
                                            <?php
                                            $currentYear = date('Y');
                                            $nextYear = $currentYear + 1;
                                            $options = '';

                                            for ($i = $nextYear; $i >= $nextYear - 1; $i--) { ?>
                                            $options .= "<option value='{{ $i }}'
                                                {{ $tahunpelajaran->tahun_akhir == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>";
                                            <?php } ?>

                                            echo $options;
                                            ?>
                                        </select>
                                        @error('tahun_akhir')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
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
            </div>
        </section>
    </div>
@endsection
