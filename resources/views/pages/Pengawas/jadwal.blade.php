@extends('layouts.app')

@section('title', 'Jadwal')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal Saya</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Jadwal Saya</div>
                </div>
            </div>
            <div class="card">
                    <div class="card-body">
                        <center>
                            <img src="img/aturan-pengawas.png" alt="aturan-pengawas" width="100%;" style="border-radius: 10px;">
                        </center>
                    </div>
                </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Mengawasi Saya</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Hari, Tanggal</th>
                                            <th class="text-center">Sesi</th>
                                            <th class="text-center">Gedung</th>
                                            <th class="text-center">Ruangan</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Mata kuliah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($tr_jadwal as $j)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->hari }}, {{ $j->trmatakuliah->tgl_ujian }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->sesi->sesi }}</td>
                                                <td class="text-center">{{ $j->trruangan->ruangan->gedung->singkat }}</td>
                                                <td class="text-center">{{ $j->trruangan->ruangan->ruangan }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->kelas }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->matkul->matakuliah }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
