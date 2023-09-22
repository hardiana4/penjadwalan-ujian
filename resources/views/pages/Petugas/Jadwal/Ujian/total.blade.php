@extends('layouts.app')

@section('title', 'Rekap Pengawas')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rekap Pengawas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Rekap Pengawas</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Rekap Pengawas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-all">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Jumlah Mengawasi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($pengawas as $p)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $p->detail->nama }}</td>
                                                <td class="text-center">{{ $countPengawas[$p->id_pengawas] ?? 0 }}</td>
                                                <td class="text-center"><a href="" button href="" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#detail_{{ $p->id_pengawas }}">
                                                        <i class="fa fa-eye"></i></a></td>
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
@foreach ($pengawas as $p)
        @include('pages.petugas.jadwal.ujian.detail')
    @endforeach

@push('scripts')
    <script>
        $("#checkAll").click(function() {
            $(".check").prop('checked', $(this).prop('checked'));
        });
    </script>
    <script>
    //     document.getElementById('deleteJadwal').onclick = function() {
    //         var idnya = [];
    //         var marked = document.getElementsByName('id_jadwal');
    //         for (var checkb of marked) {
    //             if (checkb.checked) {
    //                 var id = checkb.value;
    //                 idnya.push(id);

    //             }
    //         }

    //         $.ajax({
    //             type: "POST",
    //             url: '/checkhapus-jadwal',
    //             data: {
    //                 idnya: idnya,
    //                 _token: '{{ csrf_token() }}'
    //             },
    //             beforeSend: function() {
    //                 return confirm(
    //                     "Apakah Anda yakin ingin menghapus seluruh data penjadwalan yang dipilih?");
    //             },
    //             success: function(data) {
    //                 console.log(data);
    //                 iziToast.success({
    //                     title: 'Berhasil',
    //                     message: 'Data penjadwalan berhasil dihapus.',
    //                     position: 'topRight'
    //                 });
    //             },
    //             error: function(data, textStatus, errorThrown) {
    //                 console.log(data);
    //                 iziToast.error({
    //                     title: 'Error',
    //                     message: 'Terjadi kesalahan dalam memproses data.',
    //                     position: 'topRight'
    //                 });
    //             },
    //         });
    //     }
    // </script>
    // <script>
    //     $('.check').change(function() {
    //         if (this.checked) {
    //             $('a.disabled').removeClass("disabled");
    //         }
    //         if (!this.checked) {
    //             $('a.dis').addClass("disabled");
    //         }
    //     })
    // </script>
@endpush
