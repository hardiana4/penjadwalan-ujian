<!-- Modal -->
<div class="modal fade" id="keluar" tabindex="-1" role="dialog" aria-labelledby="keluar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="keluar">Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin keluar ?</p>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right" style="margin: 0px 0px 25px;">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-backward"></i> Kembali</button>&nbsp;
            <a href="{{route('keluar')}}" methode="post" class="btn btn-primary" onclick="location.reload()"><i class="fas fa-thumbs-up"></i> Iya, saya yakin!</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

