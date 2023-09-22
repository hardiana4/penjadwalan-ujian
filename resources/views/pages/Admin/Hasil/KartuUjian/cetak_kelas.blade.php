<!-- Modal -->
<div class="modal fade" id="cetak_kelas" role="dialog" aria-labelledby="cetak_kelas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Cetak Berdasarkan Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" target="_blank" enctype="multipart/form-data" action="{{ route('print.kelas') }}"
                    method="get">
                    <div class="form-group">
                        <label>Kelas</label><br>
                        <select class="form-control select2" name="kelas" id="kelas"
                            placeholder="- Pilih Kelas -">
                            <option value="">- Pilih Kelas -</option>
                            @foreach ($kelas as $data)
                                <option value="{{ $data->kelas }}"> {{ $data->kelas }} </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div class="row float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;
                        <button type="submit" class="btn btn-primary"><i
                                class="fas fa-print"></i>&nbsp;Cetak</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
