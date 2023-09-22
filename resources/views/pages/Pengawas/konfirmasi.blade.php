<!-- Modal -->
<div class="modal fade" id="konfirmasi_{{ $j->id }}" tabindex="-1" role="dialog" aria-labelledby="hapus_trruangan_{{ $j->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="konfirmasi">Konfirmasi Selesai Mengawasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <div class="modal-body">
        <p>Apakah Anda yakin sudah selesai mengawasi ruangan <br><strong style="color: #47c363;">{{ $j->trruangan->ruangan->ruangan }}</strong> ?</p>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right" style="margin: 0px 0px 25px;">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;
            <a href="{{route('konfirmasi', ['id'=> $j->id])}}" methode="post" class="btn btn-success">Selesai</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

