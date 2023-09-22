<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Tr_Jadwal;
use App\Models\Pengawas;
use Illuminate\Http\Request;

class PengawasController extends Controller
{
    public function jadwal()
    {
        $user = Auth::user();
        $pengawas = Pengawas::where('id_users','=',$user->id_users)->pluck('id_pengawas');
        // dd($pengawas);
        $tr_jadwal = Tr_Jadwal::whereIn('id_pengawas1', $pengawas)->orwhereIn('id_pengawas2', $pengawas)->get();

        return view("pages.pengawas.jadwal", ['type_menu' => ''], compact('user', 'tr_jadwal'));
    }


    public function konfirmasi($id)
    {
        $tr_jadwal = Tr_Jadwal::findOrFail($id);
        $user = Auth::user();
        $pengawas1 = Tr_Jadwal::where('id_pengawas1', $user->id)->count();
        $pengawas2 = Tr_Jadwal::where('id_pengawas2', $user->id)->count();
        $status1 = Tr_Jadwal::where('id_pengawas1', $user->id)->value('status_p1');
        $status2 = Tr_Jadwal::where('id_pengawas2', $user->id)->value('status_p2');
        $selesai = '0';

        if ($pengawas1 > 0 && $status1 == '1') {
            $tr_jadwal->update(['status_p1' => $selesai]);
        } elseif ($pengawas2 > 0 && $status2 == '1') {
            $tr_jadwal->update(['status_p2' => $selesai]);
        }

        return redirect('/jadwal')->with('success', 'Selamat! Anda berhasil menyelesaikan tugas!');
    }

    public function cariPengganti()
    {
        $user = Auth::user();
        $pengawas = Pengawas::where('id_users','=',$user->id_users)->pluck('id_pengawas');
        // dd($pengawas);
        $tr_jadwal = Tr_Jadwal::whereIn('id_pengawas1', $pengawas)->orwhereIn('id_pengawas2', $pengawas)->get();
        // $tgl_ujian = Tr_Matakuliahe
        return view("pages.pengawas.caripengganti", ['type_menu' => ''], compact('user', 'tr_jadwal'));
    }

}
