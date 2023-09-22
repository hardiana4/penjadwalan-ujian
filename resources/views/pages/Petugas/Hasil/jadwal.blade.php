<!-- Modal -->
<div class="modal fade" id="jadwal" role="dialog" aria-labelledby="jadwal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Cetak Jadwal per Prodi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" target="_blank" enctype="multipart/form-data"
                    action="{{ route('print.jadwal') }}" method="get">
                <div class="form-group">
                    <label>Prodi</label><br>
                    <select class="form-control selectric" name="prodi">
                        <option value="">- Pilih Prodi -</option>
                        @foreach ($prodi as $data)
                            <option value="{{ $data->id_prodi }}"> {{ $data->prodi }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div class="row float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i>&nbsp;Cetak</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
