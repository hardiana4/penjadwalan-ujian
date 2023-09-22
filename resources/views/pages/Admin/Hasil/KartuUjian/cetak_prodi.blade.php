<!-- Modal -->
<div class="modal fade" id="cetak_prodi" tabindex="-1" role="dialog" aria-labelledby="cetak_prodi" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapus">Cetak Berdasarkan Prodi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" target="_blank" enctype="multipart/form-data" action="{{ route('print.prodi') }}" method="get">
        <div class="form-group">
          <label>Prodi</label><br>
          <select class="form-control selectric"
              name="id_prodi"
              id="id_prodi" placeholder="- Pilih Prodi -">
                <option value="">- Pilih Prodi -</option>
                @foreach ($prodi as $data)
                    <option value="{{ $data->id_prodi }}"> {{ $data->prodi }} </option>
                @endforeach
          </select>
          @error('id_prodi')
              <div class='invalid-feedback'>
                  {{ $message }}
              </div>
          @enderror
        </div>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;&nbsp;
              <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i>&nbsp;Cetak</button>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

