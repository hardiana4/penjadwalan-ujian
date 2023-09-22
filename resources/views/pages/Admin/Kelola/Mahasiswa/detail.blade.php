<!-- Modal -->
<div class="modal fade" id="detail_{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapus">Detail Belum Lunas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$m->nama_mahasiswa}}</td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{$m->kelas}}</td>
          </tr>
          <tr>
            <td>UKT</td>
            <td>:</td>
            <td>{{$m->UKT}}</td>
          </tr>
          <tr>
            <td>SPI</td>
            <td>:</td>
            <td>{{$m->SPI}}</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <div class="row float-right" style="margin: 0px 0px 25px;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>&nbsp;
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
