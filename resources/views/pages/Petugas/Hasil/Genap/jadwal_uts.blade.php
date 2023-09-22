<!-- Modal -->
<div class="modal fade" id="jadwal_uts" role="dialog" aria-labelledby="jadwal_uts" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Cetak Jadwal UTS per Prodi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Prodi</label><br>
                    <select class="form-control selectric" name="nama_mahasiswa">
                        <option value="">- Pilih Prodi -</option>
                        @foreach ($prodi as $data)
                            <option value="{{ $data->id }}"> {{ $data->prodi }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div class="row float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;&nbsp;
                        <a href="" methode="post" class="btn btn-primary"><i
                                class="fas fa-print"></i>&nbsp;Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
