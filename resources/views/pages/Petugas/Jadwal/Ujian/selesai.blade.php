@extends('layouts.app')

@section('title', 'Penjadwalan UTS')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan Selesai</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Penjadwalan Ujian</div>
                    <div class="breadcrumb-item">UTS</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Penjadwalan Selesai</h4>
                            <div class="col box-header text-right">
                              <a href="{{ route('selesai') }}" id="deleteJadwal" class="btn btn-danger dis disabled"><i
                                  class="fa fa-trash-can"></i &nbsp> Hapus Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-all">
                                    <thead>
                                        <tr>
                                            <th class="text-center" >
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="check" id="checkAll">
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Sesi</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">Matakuliah</th>
                                            <th class="text-center">Ruangan</th>
                                            <th class="text-center">Pengawas</th>
                                            <th class="text-center">Pengawas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($tr_jadwal as $j)
                                            <tr>
                                              <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="check"
                                                                value="{{ $j->id }}" name="id_jadwal" id="test-cb">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->tgl_ujian }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->sesi }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->kelas }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->semester }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->matakuliah }}</td>
                                                <td class="text-center">{{ $j->trruangan->ruangan->ruangan }}</td>
                                                <td class="text-center">{{ $j->pengawas1->nama }} 
                                                @if ($j->status_p1 == '0')
                                                    <i class="fas fa-circle" style="color: #47c363"></i>
                                                @else
                                                    <i class="fas fa-circle" style="color: #fc544b"></i>
                                                @endif</td>
                                                <td class="text-center">{{ $j->pengawas2->nama }}
                                                @if ($j->status_p2 == '0')
                                                    <i class="fas fa-circle" style="color: #47c363"></i>
                                                @else
                                                    <i class="fas fa-circle" style="color: #fc544b"></i>
                                                @endif</td>
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
@endsection

@push('scripts')
    {{-- checkboxes --}}
    <script>
        $("#checkAll").click(function() {
            $(".check").prop('checked', $(this).prop('checked'));
        });
    </script>
    {{-- script hapus by checkbox --}}
    <script>
        // mengambil id button
        document.getElementById('deleteJadwal').onclick = function() {
            // membuat var array kosong
            var idnya = [];
            // mengambil semua data yang memilki name id_jadwal
            var marked = document.getElementsByName('id_jadwal');
            // melooping
            for (var checkb of marked) {
                // mengecek apakah sudah di centang boxnya
                if (checkb.checked) {
                    // mengambil value per checkbox
                    var id = checkb.value;
                    // menyimpan semua id kedalam var array
                    idnya.push(id);

                }
            }

            // memposting ke controller laravel
            $.ajax({
                type: "POST",
                url: '/checkhapus-jadwal',
                data: {
                    idnya: idnya,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    return confirm(
                        "Apakah Anda yakin ingin menghapus seluruh data penjadwalan yang dipilih?");
                },
                success: function(data) {
                    console.log(data);
                    iziToast.success({
                        title: 'Berhasil',
                        message: 'Data penjadwalan berhasil dihapus.',
                        position: 'topRight'
                    });
                },  
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                    iziToast.error({
                    title: 'Error',
                    message: 'Terjadi kesalahan dalam memproses data.',
                    position: 'topRight'
                });
                },
            });
        }
    </script>
    {{-- script auto disabled --}}
    <script>
        $('.check').change(function() {
            if (this.checked) {
                $('a.disabled').removeClass("disabled");
            }
            if (!this.checked) {
                $('a.dis').addClass("disabled");
            }
        })
    </script>
@endpush
