@extends('layouts.app')

@section('title', 'Penjadwalan UTS')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penjadwalan UTS</h1>
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
                            <h4>Daftar Jadwal UTS</h4>
                            <div class="col box-header text-right">
                                <a href="{{ route('tambah.trUTS') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i &nbsp> Tambah</a>
                                <a href="{{ route('trUTS') }}" id="generate-uts"
                                    class="btn btn-success"><i class="fa fa-circle-nodes"></i &nbsp> Generate UTS</a>
                                <a href="{{ route('trUTS') }}" id="deletePUTS" class="btn btn-danger dis disabled"><i
                                        class="fa fa-dumpster-fire"></i &nbsp> Hapus Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-all">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5px;">
                                                <div class="custom-checkbox">
                                                    <label>
                                                        <input type="checkbox" class="check" id="checkAll">
                                                        <span class="checkmark"></span>
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
                                                                value="{{ $j->id_trjadwal }}" name="id_truts" id="test-cb">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->tgl_ujian }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->sesi->sesi }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->kelas }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->semester }}</td>
                                                <td class="text-center">{{ $j->trmatakuliah->matkul->matakuliah }}</td>
                                                <td class="text-center">{{ $j->trruangan->ruangan->ruangan }}</td>
                                                <td>{{ $j->pengawas1->detail->nama }}</td>
                                                <td>{{ $j->pengawas2->detail->nama }}</td>
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
    <script>
        $("#checkAll").click(function() {
            $(".check").prop('checked', $(this).prop('checked'));
            toggleDisabledButtons();
        });

        $(".check").change(function() {
            toggleDisabledButtons();
        });

        function toggleDisabledButtons() {
            var checkedCount = $(".check:checked").length;
            var totalCount = $(".check").length;

            if (checkedCount === 0) {
                $("#checkAll").prop('checked', false);
            } else if (checkedCount === totalCount) {
                $("#checkAll").prop('checked', true);
            } else {
                $("#checkAll").prop('checked', false);
            }

            if (checkedCount > 0) {
                $('a.dis').removeClass("disabled");
            } else {
                $('a.dis').addClass("disabled");
            }
        }
    </script>

    <script>
        document.getElementById('deletePUTS').onclick = function() {
        var idnya = [];
        var marked = document.getElementsByName('id_truts');
        for (var checkb of marked) {
            if (checkb.checked) {
                var id = checkb.value;
                idnya.push(id);
            }
        }

        var confirmDialog = confirm(
            "Apakah Anda yakin ingin menghapus seluruh data penjadwalan UTS yang dipilih?");

        if (confirmDialog) {
            $.ajax({
                type: "POST",
                url: '/checkhapus-uts',
                data: {
                    idnya: idnya,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    iziToast.success({
                        title: 'Berhasil',
                        message: 'Data penjadwalan UTS berhasil dihapus.',
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
        } else {
            return false;
        }
    }

    </script>
   <script>
    document.getElementById("generate-uts").addEventListener("click", function() {
        // Persiapkan data yang akan dikirim ke server
        var data = {
            '_token': '{{ csrf_token() }}', // Token CSRF Laravel
        };

        // Kirim permintaan POST menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: '{{ route('generate.uts') }}', // Ganti dengan URL yang sesuai
            data: data,
            success: function(data) {
                console.log(data);
                iziToast.success({
                    title: 'Berhasil',
                    message: 'Data penjadwalan UTS berhasil ditambahkan.',
                    position: 'topRight'
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);

                // Cek apakah ada pesan error dalam Session
                var errorMessage = '{{ session('error_message') }}';
                if (errorMessage) {
                    iziToast.error({
                        title: 'Gagal',
                        message: errorMessage,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Pengawas tidak memenuhi kebutuhan, penjadwalan UTS tidak dilakukan secara menyeluruh.',
                        position: 'topRight'
                    });
                }
            },
        });
    });
</script>


@endpush
