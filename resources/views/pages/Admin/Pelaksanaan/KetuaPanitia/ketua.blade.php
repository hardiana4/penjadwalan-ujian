@extends('layouts.app')

@section('title', 'Ketua Panitia')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ketua Panitia</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Ketua Panitia</div>
                </div>
            </div>
            {{-- <h6>KELOLA</h6> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 20rem;">
                        <img src="{{ asset('img/ketua/' . $ketua->ttd) }}" />
                        <div class="card-body text-center">
                            <h6 style="color: #3876fb">Tanda Tangan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="detail-tab3" data-toggle="tab" href="#detail"
                                        role="tab" aria-controls="detail" aria-selected="true"><i
                                            class="fas fa-circle-info"></i> Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ubah-detail-tab3" data-toggle="tab" href="#ubah-detail"
                                        role="tab" aria-controls="ubah-detail" aria-selected="false"><i
                                            class="fas fa-pen"></i> Ubah Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#ubah-ttd" role="tab"
                                        aria-controls="ubah-ttd" aria-selected="false"><i class="fas fa-image"></i> Ubah Tanda Tangan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                    aria-labelledby="detail-tab3">
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td class="pl-4 pr-4">:</td>
                                            <td>{{ $ketua->user->detail->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td class="pl-4 pr-4">:</td>
                                            <td>{{ $ketua->nip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pengesahan</td>
                                            <td class="pl-4 pr-4">:</td>
                                            <td>{{ $ketua->tgl }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="ubah-detail" role="tabpanel"
                                    aria-labelledby="ubah-detail-tab3">
                                    <form action="{{ route('update.ketua', ['id' => $ketua->id_ketua]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Ketua Panitia</label><br>
                                            <select name="id_users"
                                                class="form-control
                                                @error('id_users')
                                                is-invalid
                                                @enderror select2"
                                                autofocus='true'>
                                                <option value="">- Pilih Ketua Panitia -</option>
                                                @foreach ($dosen as $data)
                                                    <option value="{{ $data->id_users }}"
                                                        {{ $data->id_users == $ketua->id_users ? 'selected' : '' }}>
                                                        {{ $data->detail->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_users')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="number" name="nip"
                                                class="form-control
                                            @error('nip')
                                            is-invalid
                                            @enderror"
                                                value="{{ $ketua->nip }}">
                                            @error('nip')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pengesahan Kartu Ujian</label>
                                            <input type="text" autocomplete="off"  class="form-control @error('tgl') is-invalid @enderror"
                                                id="tgl_pengesahan" name="tgl" value="{{ $ketua->tgl }}">
                                            @error('tgl')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row float-right" style="margin: 0px 0px 25px;">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="ubah-ttd" role="tabpanel" aria-labelledby="ubah-ttd-tab3">
                                    <form action="{{ route('update.ttd', ['id' => $ketua->id_ketua]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tanda Tangan</label>
                                            <input type="file" class="form-control @error('ttd') is-invalid @enderror" name="ttd" accept=".jpg, .jpeg, .png">
                                            @error('ttd')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row float-right" style="margin: 0px 0px 25px;">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
        flatpickr("#tgl_pengesahan", {
            dateFormat: "j F Y",
            locale: "id",
        });
    </script>
@endpush
