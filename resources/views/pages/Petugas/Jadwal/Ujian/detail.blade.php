<!-- Modal -->
<div class="modal fade" id="detail_{{ $p->id_pengawas }}" tabindex="-1" role="dialog" aria-labelledby="info"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Detail Rekap Mengawasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $p->detail->nama }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>{{ $countPengawas[$p->id_pengawas] ?? 0 }}</td>
                    </tr>
                </table>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Hari, Tanggal</th>
                                <th class="text-center">Jam</th>
                                <th class="text-center">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (
                                $tr_jadwal->isEmpty() ||
                                    !$tr_jadwal->contains(function ($item) use ($p) {
                                        return $item->id_pengawas1 == $p->id_pengawas || $item->id_pengawas2 == $p->id_pengawas;
                                    }))
                                <tr>
                                    <td class="text-center" colspan="4">Data tidak ditemukan.</td>
                                </tr>
                            @else
                                @foreach ($tr_jadwal as $j)
                                    @if ($j->id_pengawas1 == $p->id_pengawas || $j->id_pengawas2 == $p->id_pengawas)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-center">{{ $j->trmatakuliah->hari }},
                                                {{ $j->trmatakuliah->tgl_ujian }}</td>
                                            <td class="text-center">{{ $j->trmatakuliah->sesi->sesi }}</td>
                                            <td class="text-center">{{ $j->trruangan->ruangan->ruangan }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
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
