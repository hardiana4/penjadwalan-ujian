<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pengawas;
use App\Models\Ruangan;
use App\Models\Tr_Matakuliah;
use App\Models\Tr_Ruangan;
use App\Models\Tr_Jadwal;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function getMatkul(Request $request)
    {
        $id_prodi = $request->input('id_prodi');
        $semester = $request->input('semester');

        $matkuls = Matakuliah::where('id_prodi', $id_prodi)
            ->where('semester', $semester)
            ->get();
        return response()->json($matkuls);
    }

    public function getKelas()
    {
        $kelas = Tr_Matakuliah::distinct('kelas')->pluck('kelas');
        return response()->json($kelas);
    }

    public function getTrRuanganKelas()
    {
        $kelas = Tr_Ruangan::pluck('kelas');
        return response()->json($kelas);
    }

    public function getRuangan(Request $request)
    {
        $kelas = $request->input('kelas');
        $sesi  = Tr_Matakuliah::where('kelas',$kelas)->pluck('id_sesi');
        $tgl_ujian  = Tr_Matakuliah::where('kelas',$kelas)->pluck('tgl_ujian');

        $kelasLain = Tr_Matakuliah::where('kelas','!=',$kelas)
                                  ->whereIn('id_sesi',$sesi)
                                  ->whereIn('tgl_ujian',$tgl_ujian)
                                  ->distinct('kelas')->pluck('kelas');

        $idRuangan = Tr_Ruangan::whereIn('kelas',$kelasLain)->pluck('id_ruangan');
        $ruangans = Ruangan::whereNotIn('id_ruangan',$idRuangan)->get();
        return response()->json($ruangans);
    }

    public function getKelasUjian(Request $request)
    {
        $id_prodi = $request->input('id_prodi');
        $semester = $request->input('semester');
        $kode_kelas = $request->input('kode_kelas');

        if (empty($id_prodi)|| empty($semester)|| empty($kode_kelas)) {
            return response()->json(['Data kelas tidak ditemukan.']); // Mengembalikan pesan jika tidak ada kelas
        }

        $kelasujian = Tr_Matakuliah::where('id_prodi', $id_prodi)
            ->where('semester', $semester)
            ->where('kode_kelas', $kode_kelas)
            ->distinct('kelas')
            ->pluck('kelas');
        if (empty($kelasujian)) {
            return response()->json(['Data kelas tidak ditemukan.']); // Mengembalikan pesan jika tidak ada data ruangan
        }
        return response()->json($kelasujian);
    }

   public function getTglUjian(Request $request)
    {
        $kelas = $request->input('kelas');
        // $id_prodi = $request->input('id_prodi');
        // $semester = $request->input('semester');
        // $kode_kelas = $request->input('kode_kelas');

        $tglujians = Tr_Matakuliah::where('kelas', $kelas)
                                    ->distinct('tgl_ujian')
                                    ->pluck('tgl_ujian')
                                    ->toArray();
        // $tglujians = Tr_Matakuliah::where('id_prodi', $id_prodi)
        //                             ->where('semester', $semester)
        //                             ->where('kode_kelas', $kode_kelas)
        //                             ->distinct('tgl_ujian')
        //                             ->pluck('tgl_ujian')
        //                             ->toArray();

        return response()->json($tglujians);
    }

    public function getSesiUjian(Request $request)
    {
        // $id_prodi = $request->input('id_prodi');
        // $semester = $request->input('semester');
        // $kode_kelas = $request->input('kode_kelas');
        $kelas = $request->input('kelas');
        $tgl_ujian = $request->input('tgl_ujian');

        $sesi = Tr_Matakuliah::with('sesi')->where('kelas', $kelas)
                                ->where('tgl_ujian', $tgl_ujian)
                                ->get()
                                ->toArray();
        return response()->json($sesi);
    }

    public function getMatakuliahUjian(Request $request)
    {
        // $id_prodi = $request->input('id_prodi');
        // $semester = $request->input('semester');
        // $kode_kelas = $request->input('kode_kelas');
        $kelas = $request->input('kelas');
        $tgl_ujian = $request->input('tgl_ujian');
        $sesi = $request->input('sesi');

        if (empty($tgl_ujian)) {
            return response()->json([]); // Mengembalikan array kosong jika input kosong
        }

        $matkul = Tr_Matakuliah::with('matkul')->where('kelas', $kelas)
                                ->where('tgl_ujian', $tgl_ujian)
                                ->where('id_sesi', $sesi)
                                ->get()
                                ->toArray();
        return response()->json($matkul);
    }

    public function getMatkulTrJadwal(Request $request)
    {
        $trmatkul = Tr_Jadwal::pluck('id_trmatakuliah')->toArray();
        return response()->json($trmatkul);
    }


    public function getRuanganUjian(Request $request)
    {
        $kelas = $request->input('kelas');

        if (empty($kelas)) {
            return response()->json(['Data ruangan tidak ditemukan.']); // Mengembalikan pesan jika tidak ada kelas
        }

        $ruanganujians = Tr_Ruangan::where('kelas', $kelas)
            ->join('ruangan', 'ruangan.id_ruangan', '=', 'tr_ruangan.id_ruangan')
            ->pluck('ruangan.ruangan', 'tr_ruangan.id_trruangan')
            ->toArray();

        if (empty($ruanganujians)) {
            return response()->json(['Data ruangan tidak ditemukan.']); // Mengembalikan pesan jika tidak ada data ruangan
        }

        $ruanganData = array_map(function ($ruangan, $id) {
            return ['ruangan.ruangan' => $ruangan, 'tr_ruangan.id_trruangan' => $id];
        }, $ruanganujians, array_keys($ruanganujians));

        return response()->json($ruanganData);
    }

   public function getPengawas1Ujian(Request $request)
    {
        $sesi = $request->input('sesi');
        $tgl_ujian = $request->input('tgl_ujian');
        $matakuliah = $request->input('id_trmatakuliah');

        if (empty($sesi) || empty($tgl_ujian)) {
            return response()->json([]);
        }

        $pengampu = Tr_Matakuliah::where('id_trmatakuliah', $matakuliah)->pluck('id_pengawas');

        $matkulLain = Tr_Matakuliah::where('tgl_ujian', $tgl_ujian)
                                    ->where('id_sesi', $sesi)
                                    ->pluck('id_trmatakuliah');

        $idPengawas = Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                                ->pluck('id_pengawas1')
                                ->merge(Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                                                ->pluck('id_pengawas2'));

        $pengawas1 = Pengawas::join('detail','detail.id_detail','=','pengawas.id_detail')
            ->where('pengawas.kuota', '!=', 0)
            ->whereNotIn('pengawas.id_pengawas', $idPengawas)
            ->where('pengawas.id_pengawas','!=',$pengampu)
            ->pluck('detail.nama', 'pengawas.id_pengawas')
            ->toArray();

        $pengawasData = array_map(function ($nama, $id) {
        return ['id_pengawas' => $id, 'detail' => ['nama' => $nama]];
        }, $pengawas1, array_keys($pengawas1));

        return response()->json($pengawasData);
    }

    public function getPengawas2Ujian(Request $request)
    {
        $sesi = $request->input('sesi');
        $tgl_ujian = $request->input('tgl_ujian');
        $matakuliah = $request->input('id_trmatakuliah');
        $id_pengawas1 = $request->input('id_pengawas1');

        if (empty($sesi) || empty($tgl_ujian)) {
            return response()->json([]);
        }

        $pengampu = Tr_Matakuliah::where('id_trmatakuliah', $matakuliah)->pluck('id_pengawas');

        $matkulLain = Tr_Matakuliah::where('tgl_ujian', $tgl_ujian)
                                    ->where('id_sesi', $sesi)
                                    ->pluck('id_trmatakuliah');

        $idPengawas = Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                                ->pluck('id_pengawas1')
                                ->merge(Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                                                ->pluck('id_pengawas2'));

        $pengawas2 = Pengawas::join('detail','detail.id_detail','=','pengawas.id_detail')
            ->where('pengawas.kuota', '!=', 0)
            ->where('pengawas.id_pengawas', '!=', $id_pengawas1)
            ->where('pengawas.id_pengawas', '!=', $pengampu)
            ->whereNotIn('pengawas.id_pengawas', $idPengawas)
            ->pluck('detail.nama', 'pengawas.id_pengawas')
            ->toArray();

        $pengawasData = array_map(function ($nama, $id) {
        return ['id_pengawas' => $id, 'detail' => ['nama' => $nama]];
        }, $pengawas2, array_keys($pengawas2));

        return response()->json($pengawasData);
    }

}
