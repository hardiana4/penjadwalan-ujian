@extends('layouts.app')

@section('title', 'Kartu Ujian')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kartu Ujian</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/beranda') }}">Beranda</a></div>
                    <div class="breadcrumb-item">Kartu Ujian</div>
                </div>
            </div>
            <div class="alert alert-danger alert-dismissible show fade alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    @foreach ($ketua as $data)
                        Tanggal mengesahkan kartu ujian saat ini ialah <strong
                            style="color: yellow;">{{ $data->tgl_sah }}</strong> dengan ketua panitia <strong
                            style="color: yellow;">{{ $data->user->detail->nama }}</strong>. Ubah apabila belum sesuai di <a
                            href="{{ route('ketua') }}"><ins>sini</ins></a>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card-cetak gradient-1">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#cetak_prodi">
                            <h6 class="card-title text-white">Cetak berdasarkan</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">Prodi</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-landmark"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card-cetak gradient-2">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#cetak_kelas">
                            <h6 class="card-title text-white">Cetak berdasarkan</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">Kelas</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-people-group"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card-cetak gradient-3">
                        <div class="card-body" type="button" data-toggle="modal" data-target="#cetak_mahasiswa">
                            <h6 class="card-title text-white">Cetak berdasarkan</h6>
                            <div class="d-inline-block">
                                <h1 class="text-white">Mahasiswa</h1>
                                <p> </p>
                            </div>
                            <span class="float-right text-white"><i class="fas fa-person"
                                    style="font-size: 3rem; opacity: 0.5;"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.admin.hasil.KartuUjian.cetak_prodi')
    @include('pages.admin.hasil.KartuUjian.cetak_kelas')
    @include('pages.admin.hasil.KartuUjian.cetak_mahasiswa')
    @include('pages.admin.hasil.KartuUjian.konfirmasiCetak')
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#namas').on('change', function() {
            var $option = $(this).find(':selected')
            var npm = $option.data('npm');
            var prodi = $option.data('prodi');
            var id = $option.data('id');
            var status = $option.data('status');

            $('#npm').val(npm).text();
            $('#prodi').val(prodi).text();

            $('#cetakButton').off('click');

            if (status === 0) {
                $('#cetakButton').on('click', function() {
                    $('#belumLunas').modal('show');
                });
            } else {
                $('#cetakButton').on('click', function() {
                    var form = $(this).closest('form');
                    var url = form.attr('action');
                    var queryString = form.serialize();
                    var fullUrl = url + '?' + queryString;
                    window.open(fullUrl, '_blank');
                });
            }
        });
            $('#belumLunas').on('show.bs.modal', function(event) {
           var modal = $(this);
           var cetakButton = modal.find('.btn-warning');
           cetakButton.on('click', function() {
               var cetakForm = $('#cetak_mahasiswa').find('form');
               cetakForm.submit();
           });
        });
    </script>
@endpush
