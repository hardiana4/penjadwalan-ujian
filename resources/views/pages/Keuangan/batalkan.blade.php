<!-- Modal -->
<div class="modal fade" id="batalkan_{{ $m->id_mahasiswa }}" tabindex="-1" role="dialog" aria-labelledby="info"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Batalkan Status Lunas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.batalkan', ['id' => $m->id_mahasiswa])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>UKT</label>
                        <input type="text" autocomplete="off"  name="UKT"
                            class="form-control @error('UKT')
                                is-invalid
                                @enderror"
                            id="UKT" value="{{ old('UKT') }}" autofocus='true' placeholder="Masukan UKT" oninput="formatRupiah(this)" autocomplete="off">
                        @error('UKT')
                            <div class='invalid-feedback'>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>SPI</label>
                        <input name="SPI"
                            class="form-control @error('SPI')
                                is-invalid
                                @enderror"
                            id="SPI" value="{{ old('SPI') }}" placeholder="Masukan SPI " oninput="formatRupiah(this)" autocomplete="off">
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
