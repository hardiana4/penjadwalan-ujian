<!-- Modal -->
<div class="modal fade" id="berkas_uts" role="dialog" aria-labelledby="berkas_uts" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Cetak Daftar Pengambilan Berkas UTS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal Ujian</label><br>
                    <select class="form-control selectric" name="nama_mahasiswa">
                        <option value="">- Pilih Tanggal -</option>
                        @foreach ($tgl as $data)
                            <option value="{{ $data->tgl_ujian }}"> {{$data->hari}}, {{ $data->tgl_ujian }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Sesi</label><br>
                    <select class="form-control selectric" name="nama_mahasiswa">
                        <option value="">- Pilih Sesi -</option>
                        <option value="08.00 - 09.30"> 08.00 - 09.30 </option>
                        <option value="10.00 - 11.30"> 10.00 - 11.30 </option>
                        <option value="13.30 - 15.00"> 13.30 - 15.00 </option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div class="row float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;&nbsp;
                        <a href="{{route('print.berkas.uts')}}" methode="post" class="btn btn-primary"><i
                                class="fas fa-print"></i>&nbsp;Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
