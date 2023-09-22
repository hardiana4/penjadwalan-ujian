<!-- Modal -->
<div class="modal fade" id="ubah_{{ $m->id_mahasiswa }}" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus"> Ubah Detail Kurang Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.kurang',['id' => $m->id_mahasiswa])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>UKT</label>
                        <input type="text" autocomplete="off"  class="form-control" id="UKT" name="UKT" oninput="formatRupiah(this)" placeholder="Masukkan UKT" value="{{$m->UKT}}" >
                        @error('UKT')
                            <div class='invalid-feedback'>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>SPI</label>
                        <input type="text" autocomplete="off"  class="form-control" id="SPI" name="SPI" oninput="formatRupiah(this)" placeholder="Masukkan SPI" value="{{$m->SPI}}">
                        @error('SPI')
                            <div class='invalid-feedback'>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div class="row float-right" style="margin: 0px 0px 25px;">
                        <button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
