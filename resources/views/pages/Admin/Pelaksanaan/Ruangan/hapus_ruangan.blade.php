<!-- Modal -->
<div class="modal fade" id="hapus_ruangan_{{ $r->id_ruangan }}" tabindex="-1" role="dialog" aria-labelledby="hapus_ruangan_{{ $r->id_ruangan }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapus">Hapus ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus <strong style="color: #fb160a;">{{ $r->ruangan }}</strong>?</p>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right" style="margin: 0px 0px 25px;">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>&nbsp;
                {{-- <a href="{{route('delete.ruangan',['id'=> $r->id_ruangan])}}" methode="post" class="btn btn-danger">Hapus</a> --}}
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

