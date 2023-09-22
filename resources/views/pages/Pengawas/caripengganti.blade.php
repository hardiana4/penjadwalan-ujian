@extends('layouts.app')

@section('title', 'Jadwal')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pencarian Pengganti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Pencarian Pengganti</div>
                </div>
            </div>
                    <div class="row">
                        <div class="col-md-5">
                    <div class="card" style="position: sticky; top: 10px;">
                        <div class="card-header">
                            <h4>Cari Pengganti</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.ruangan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Tanggal Ujian</label><br>
                                        <select
                                            class="form-control selectric
                                @error('tgl_ujian') is-invalid @enderror"
                                            name="tgl_ujian" id="tgl_ujian" placeholder="- Pilih Gedung -">
                                            <option value="">- Pilih Tanggal Ujian -</option>
                                            {{-- @foreach ($gedung as $data)
                                                <option value="{{ $data->id_gedung }}"
                                                    {{ old('id_gedung') == $data->id_gedung ? 'selected' : '' }}>
                                                    {{ $data->singkat }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                        @error('tgl_ujian')
                                            <div class='invalid-feedback d-block'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label>Tanggal Ujian</label><br>
                                        <select
                                            class="form-control selectric
                                @error('id_sesi') is-invalid @enderror"
                                            name="id_sesi" id="id_sesi" placeholder="- Pilih Gedung -">
                                            <option value="">- Pilih Sesi -</option>
                                            {{-- @foreach ($gedung as $data)
                                                <option value="{{ $data->id_gedung }}"
                                                    {{ old('id_gedung') == $data->id_gedung ? 'selected' : '' }}>
                                                    {{ $data->singkat }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                        @error('id_sesi')
                                            <div class='invalid-feedback d-block'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row float-right" style="margin: 0px 0px 25px;">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp;Cari</button>
                                    </div>
                                    </form>
                                </div>
                    </div>
                </div>
                        <div class="col-md-7">

                    <div class="card">
                        <div class="card-header">
                            <h4>Hasil Pencarian</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5px;">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Prodi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        {{-- @foreach ($tr_jadwal as $j)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->hari }}, {{ $j->trmatakuliah->tgl_ujian }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->sesi->sesi }}</td>
                                                <td class="text-center">{{ $j->trruangan->ruangan->gedung->singkat }}</td>
                                                <td class="text-center">{{ $j->trruangan->ruangan->ruangan }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->kelas }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->matkul->matakuliah }}</td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>
    {{-- @foreach ($tr_jadwal as $j)
        @include('pages.Pengawas.konfirmasi')
        @endforeach     --}}
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
    </script>
@endpush
