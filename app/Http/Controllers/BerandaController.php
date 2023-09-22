<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\Matakuliah;
use App\Models\Gedung;
use App\Models\Tr_Matakuliah;

class BerandaController extends Controller
{
    public function landingpage()
    {
        $prodi = Prodi::get();
        return view("pages.tamu.index", compact('prodi'));
    }

    public function masuk()
    {
        return view("pages.masuk");
    }

    public function index()
    {
        $user = Auth::User();
        $dt_prodi = Prodi::count();
        $dt_pengguna = User::count();
        $dt_mahasiswa = Mahasiswa::count();
        $dt_ruangan = Ruangan::count();
        $dt_matakuliah = Matakuliah::distinct('matakuliah')->count();
        $dt_gedung = Gedung::count();

        return view("pages.beranda", compact('dt_prodi','dt_pengguna','dt_mahasiswa','dt_ruangan','dt_matakuliah','dt_gedung'), ['type_menu' => ''])->with([
            "user" => $user,]);
    }
}
