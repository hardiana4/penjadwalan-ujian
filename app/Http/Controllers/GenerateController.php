<?php

namespace App\Http\Controllers;
use App\Models\Pengawas;
use App\Models\Ketua;
use App\Models\Ruangan;
use App\Models\Tahun_Pelajaran;
use App\Models\Tr_Matakuliah;
use App\Models\Tr_Ruangan;
use App\Models\Tr_Jadwal;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
   public function generateRuangan()
    {
        $kelasUnique = Tr_Matakuliah::distinct('kelas')->pluck('kelas');
        foreach ($kelasUnique as $kelas) {
            $trKelas = Tr_Ruangan::where('kelas', $kelas)->first();

            // Cek apakah ada Tr_Ruangan dengan kelas yang sama
            if (!$trKelas) {
                $sesi = Tr_Matakuliah::where('kelas', $kelas)->pluck('id_sesi');
                $tgl_ujian = Tr_Matakuliah::where('kelas', $kelas)->pluck('tgl_ujian');

                $kelasTrMatkul = Tr_Matakuliah::where('kelas', '!=', $kelas)
                    ->whereIn('id_sesi', $sesi)
                    ->whereIn('tgl_ujian', $tgl_ujian)
                    ->distinct('kelas')
                    ->pluck('kelas');

                $idRuangan = Tr_Ruangan::whereIn('kelas', $kelasTrMatkul)->pluck('id_ruangan');
                $ruangan = Ruangan::whereNotIn('id_ruangan', $idRuangan)->first();

                // Jika belum ada, buat rekord baru di tabel tr_ruangan
                if ($ruangan) {
                    $trKelas = new Tr_Ruangan();
                    $trKelas->id_ruangan = $ruangan->id_ruangan; // Sesuaikan dengan nilai id_ruangan yang sesuai
                    $trKelas->kelas = $kelas;
                    $trKelas->save();
                }
            }
        }
    }

   public function generateUTS()
    {
        $matkulUnique = Tr_Matakuliah::pluck('id_trmatakuliah');

        foreach ($matkulUnique as $matkul) {
            $trJadwal = Tr_Jadwal::where('id_trmatakuliah', $matkul)->first();

            if (!$trJadwal) {
                $kelasTrMatkul = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('kelas');
                $ruangan = Tr_Ruangan::where('kelas', $kelasTrMatkul)->first();
                $jenis = 'UTS';
                $kode = 'FM.PUTSUTS-C.03-R0';
                $id_tp = Tahun_Pelajaran::where('id_tp', '1')->value('id_tp');

                $pengampu = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('id_pengawas');
                $sesi = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('id_sesi');
                $tgl_ujian = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('tgl_ujian');

                $matkulLain = Tr_Matakuliah::where('id_trmatakuliah', '!=', $matkul)
                    ->where('tgl_ujian', $tgl_ujian)
                    ->where('id_sesi', $sesi)
                    ->pluck('id_trmatakuliah');

                $idPengawas = Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                    ->pluck('id_pengawas1')
                    ->merge(Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                        ->pluck('id_pengawas2'));

                $pengawas1 = Pengawas::where('kuota', '!=', 0)
                    ->whereNotIn('id_pengawas', $idPengawas)
                    ->where('id_pengawas', '!=', $pengampu)
                    ->inRandomOrder()->first();

                $pengawas2 = Pengawas::where('kuota', '!=', 0)
                    ->whereNotIn('id_pengawas', $idPengawas)
                    ->where('id_pengawas', '!=', $pengawas1->id_pengawas)
                    ->where('id_pengawas', '!=', $pengampu)
                    ->inRandomOrder()->first();

                $idPengawas1 = Pengawas::where('id_pengawas',$pengawas1->id_pengawas)->value('kuota');
                $idPengawas2 = Pengawas::where('id_pengawas',$pengawas2->id_pengawas)->value('kuota');

                    if ($idPengawas1 == 4){
                    $kuota1 = 3;
                    } elseif ($idPengawas1 == 3){
                        $kuota1 = 2;
                    } elseif ($idPengawas1 == 2){
                        $kuota1 = 1;
                    } elseif ($idPengawas1 == 1) {
                        $kuota1 = 0;
                    }

                    if ($idPengawas2 == 4){
                        $kuota2 = 3;
                    } elseif ($idPengawas2 == 3){
                        $kuota2 = 2;
                    } elseif ($idPengawas2 == 2){
                        $kuota2 = 1;
                    } elseif ($idPengawas2 == 1) {
                        $kuota2 = 0;
                    }

                $countUAS = Tr_Jadwal::where('jenis','UAS')->count();
                if ($countUAS > 0) {
                    // Jika terdapat jenis UAS, kirimkan error
                    return back()->withErrors("Anda masih mempunyai penjadwalan UAS, <strong>hapus semua penjadwalan UAS</strong> sebelum memulai penjadwalan UTS.");
                }

                if ($pengawas1 && $pengawas2) {
                    // Jika belum ada, buat rekord baru di tabel tr_jadwal
                    $trJadwal = new Tr_Jadwal();
                    $trJadwal->id_tp = $id_tp;
                    $trJadwal->id_trmatakuliah = $matkul;
                    $trJadwal->id_trruangan = $ruangan->id_trruangan;
                    $trJadwal->id_pengawas1 = $pengawas1->id_pengawas;
                    $trJadwal->id_pengawas2 = $pengawas2->id_pengawas;
                    $trJadwal->jenis = $jenis;
                    $trJadwal->kode = $kode;
                    $trJadwal->save();

                    Pengawas::where('id_pengawas', $pengawas1->id_pengawas)->update(['kuota' => $kuota1]);
                    Pengawas::where('id_pengawas', $pengawas2->id_pengawas)->update(['kuota' => $kuota2]);
                }
            }
        }
    }

   public function generateUAS()
    {
        $matkulUnique = Tr_Matakuliah::pluck('id_trmatakuliah');

        foreach ($matkulUnique as $matkul) {
            $trJadwal = Tr_Jadwal::where('id_trmatakuliah', $matkul)->first();

            if (!$trJadwal) {
                $kelasTrMatkul = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('kelas');
                $ruangan = Tr_Ruangan::where('kelas', $kelasTrMatkul)->first();
                $jenis = 'UAS';
                $kode = 'FM.PUTSUAS-C.03-R0';
                $id_tp = Tahun_Pelajaran::where('id_tp', '1')->value('id_tp');

                $pengampu = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('id_pengawas');
                $sesi = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('id_sesi');
                $tgl_ujian = Tr_Matakuliah::where('id_trmatakuliah', $matkul)->pluck('tgl_ujian');

                $matkulLain = Tr_Matakuliah::where('id_trmatakuliah', '!=', $matkul)
                    ->where('tgl_ujian', $tgl_ujian)
                    ->where('id_sesi', $sesi)
                    ->pluck('id_trmatakuliah');

                $idPengawas = Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                    ->pluck('id_pengawas1')
                    ->merge(Tr_Jadwal::whereIn('id_trmatakuliah', $matkulLain)
                        ->pluck('id_pengawas2'));

                $pengawas1 = Pengawas::where('kuota', '!=', 0)
                    ->whereNotIn('id_pengawas', $idPengawas)
                    ->where('id_pengawas', '!=', $pengampu)
                    ->inRandomOrder()->first();

                $pengawas2 = Pengawas::where('kuota', '!=', 0)
                    ->whereNotIn('id_pengawas', $idPengawas)
                    ->where('id_pengawas', '!=', $pengawas1->id_pengawas)
                    ->where('id_pengawas', '!=', $pengampu)
                    ->inRandomOrder()->first();

                $idPengawas1 = Pengawas::where('id_pengawas',$pengawas1->id_pengawas)->value('kuota');
                $idPengawas2 = Pengawas::where('id_pengawas',$pengawas2->id_pengawas)->value('kuota');

                    if ($idPengawas1 == 4){
                    $kuota1 = 3;
                    } elseif ($idPengawas1 == 3){
                        $kuota1 = 2;
                    } elseif ($idPengawas1 == 2){
                        $kuota1 = 1;
                    } elseif ($idPengawas1 == 1) {
                        $kuota1 = 0;
                    }

                    if ($idPengawas2 == 4){
                        $kuota2 = 3;
                    } elseif ($idPengawas2 == 3){
                        $kuota2 = 2;
                    } elseif ($idPengawas2 == 2){
                        $kuota2 = 1;
                    } elseif ($idPengawas2 == 1) {
                        $kuota2 = 0;
                    }

                $countUTS = Tr_Jadwal::where('jenis','UTS')->count();
                if ($countUTS > 0) {
                    // Jika terdapat jenis UTS, kirimkan error
                    return back()->withErrors("Anda masih mempunyai penjadwalan UTS, <strong>hapus semua penjadwalan UTS</strong> sebelum memulai penjadwalan UAS.");
                }

                if ($pengawas1 && $pengawas2) {
                    // Jika belum ada, buat rekord baru di tabel tr_jadwal
                    $trJadwal = new Tr_Jadwal();
                    $trJadwal->id_tp = $id_tp;
                    $trJadwal->id_trmatakuliah = $matkul;
                    $trJadwal->id_trruangan = $ruangan->id_trruangan;
                    $trJadwal->id_pengawas1 = $pengawas1->id_pengawas;
                    $trJadwal->id_pengawas2 = $pengawas2->id_pengawas;
                    $trJadwal->jenis = $jenis;
                    $trJadwal->kode = $kode;
                    $trJadwal->save();

                    Pengawas::where('id_pengawas', $pengawas1->id_pengawas)->update(['kuota' => $kuota1]);
                    Pengawas::where('id_pengawas', $pengawas2->id_pengawas)->update(['kuota' => $kuota2]);
                }
            }
        }
    }
}
