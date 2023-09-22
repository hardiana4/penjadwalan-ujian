<div class="modal fade" id="kelas" role="dialog" aria-labelledby="kelas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelmodal">
                    <img src="img/SIP UJIANpnc.png" alt="logo-sipu" style="width: 100px;">
                </h5>
            </div>
            <div class="modal-body">
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
                            @foreach ($kelas as $k)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">{{ $k->hari }}, {{ $k->tgl_ujian }}</td>
                                    <td class="text-center">{{ $k->sesi }}</td>
                                    <td class="text-center">{{ $k->id_matakuliah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
