<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelLabel">Import Data Pengawas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('import.pengawas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <p>Apabila Anda belum memiliki format import pengawas, silakan unduh melalui tombol di bawah ini.</p>
                    <a href="{{ route('download.templatePgw') }}" class="btn btn-warning">
                        <i class="fa fa-download"></i>&nbsp;&nbsp;Template Import
                    </a>
                    <br>
                    <br>
                    <div class="form-group">
                        <label>File Excel</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" accept=".xls, .xlsx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-file-import"></i>&nbsp;&nbsp;Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
