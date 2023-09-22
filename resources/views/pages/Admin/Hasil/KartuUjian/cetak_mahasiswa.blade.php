<!-- Modal -->
<div class="modal fade" id="cetak_mahasiswa" role="dialog" aria-labelledby="cetak_mahasiswa" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Cetak Berdasarkan Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" target="_blank" enctype="multipart/form-data" action="{{ route('print.mhs')}}" id="cetakForm">
                    <div class="form-group">
                        <label>Mahasiswa</label><br>
                        <select class="form-control select2" name="idMhs" id="namas">
                            <option value="">- Pilih Mahasiswa -</option>
                            @foreach ($mahasiswa as $data)
                                <option value="{{ $data->id_mahasiswa }}" data-id="{{ $data->id_mahasiswa }}"
                                    data-npm="{{ $data->npm }}" data-prodi="{{ $data->prodi->prodi }}" data-status="{{ $data->status }}">
                                    {{ $data->nama_mahasiswa }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" autocomplete="off"  name="npm" class="form-control" id="npm" readonly>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <input type="text" autocomplete="off"  name="prodi" class="form-control" id="prodi" readonly>
                    </div>
                    <div class="modal-footer">
                        <div class="row float-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="cetakButton"><i class="fas fa-print"></i>&nbsp;Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
