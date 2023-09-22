<!-- Modal -->
<div class="modal fade" id="hapus_trmatakuliah_{{ $m->id_trmatakuliah }}" tabindex="-1" role="dialog" aria-labelledby="hapus_trmatakuliah_{{ $m->id_trmatakuliah }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapus">Hapus Penjadwalan Matakuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus penjadwalan di kelas <strong style="color: #fb160a;">{{ $m->kelas }}</strong> dengan matakuliah <strong style="color: #fb160a;">{{ $m->matakuliah }}</strong> pada <strong style="color: #fb160a;">{{ $m->hari }}, {{$m->tgl_ujian}}</strong> jam <strong style="color: #fb160a;">{{ $m->sesi }}</strong> ?</p>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right" style="margin: 0px 0px 25px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>&nbsp;
            <a href="{{route('delete.trmatakuliahD3', ['id'=> $m->id_trmatakuliah])}}" methode="post" class="btn btn-danger">Hapus</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

