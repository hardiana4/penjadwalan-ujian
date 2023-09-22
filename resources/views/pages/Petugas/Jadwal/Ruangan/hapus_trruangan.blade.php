<!-- Modal -->
<div class="modal fade" id="hapus_trruangan_{{ $r->id_trruangan }}" tabindex="-1" role="dialog" aria-labelledby="hapus_trruangan_{{ $r->id_trruangan }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapus">Hapus Penjadwalan Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus penjadwalan ruangan pada kelas <strong style="color: #fb160a;">{{ $r->kelas }}</strong> di ruangan <strong style="color: #fb160a;">{{ $r->ruangan->ruangan }}</strong> ?</p>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right" style="margin: 0px 0px 25px;">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>&nbsp;
            <a href="{{route('delete.trruangan', ['id'=> $r->id_trruangan])}}" methode="post" class="btn btn-danger">Hapus</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

