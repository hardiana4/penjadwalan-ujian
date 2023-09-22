<!-- Modal -->
<div class="modal fade" id="berkas" role="dialog" aria-labelledby="berkas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Cetak Daftar Pengambilan Berkas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" target="_blank" enctype="multipart/form-data"
                    action="{{ route('print.berkas') }}" method="get">
                    <div class="form-group">
                        <label>Tanggal Ujian</label><br>
                        <select class="form-control selectric" name="tgl_ujian">
                            <option value="">- Pilih Tanggal -</option>
                            @foreach ($tgl as $data)
                                <option value="{{ $data->tgl_ujian }}"> {{ $data->hari }}, {{ $data->tgl_ujian }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sesi</label><br>
                        <select class="form-control selectric" name="id_sesi">
                            <option value="">- Pilih Sesi -</option>
                            @foreach ($sesi as $s)
                                <option value="{{ $s->id_sesi }}"> {{ $s->sesi }} </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <div class="row float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary"><div class="col-md-5">
                    <div class="card" style="position: sticky; top: 10px;">
                        <div class="card-header">
                            <h4>Tambah Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.ruangan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Gedung</label><br>
                                        <select
                                            class="form-control selectric
                                @error('id_gedung') is-invalid @enderror"
                                            name="id_gedung" id="id_gedung" placeholder="- Pilih Gedung -">
                                            <option value="">- Pilih Gedung -</option>
                                            @foreach ($gedung as $data)
                                                <option value="{{ $data->id_gedung }}"
                                                    {{ old('id_gedung') == $data->id_gedung ? 'selected' : '' }}>
                                                    {{ $data->singkat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_gedung')
                                            <div class='invalid-feedback d-block'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Ruangan</label>
                                    <input type="text" autocomplete="off"  name="ruangan"
                                        class="form-control @error('ruangan')
                                is-invalid
                                @enderror"
                                        id="ruangan" value="{{ old('ruangan') }}" autofocus='true'
                                        placeholder="Masukan nama ruangan">
                                    @error('ruangan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row float-right" style="margin: 0px 0px 25px;">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>Cetak</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
