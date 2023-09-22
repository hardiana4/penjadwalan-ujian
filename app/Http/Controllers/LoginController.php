<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Tahun_Pelajaran;
use App\Models\Tr_Ruangan;
use App\Models\Tr_Matakuliah;
use App\Models\Tr_Jadwal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Tr_Matakuliah::select('kelas')->distinct()->get();

        return response()
            ->view("pages.tamu.index", compact('kelas'))
            ->header('Cache-Control', 'no-store, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function hasilPencarian(Request $request)
    {
        $reqKelas = $request->input('kelas');
        $matkul = Tr_Matakuliah::with('matkul','sesi')->where('kelas',$reqKelas)->orderBy('tgl_ujian')->orderby('id_sesi')->get();
        foreach ($matkul as $mk) {
            Date::setLocale('id');
            $mk->tgl_ujian = Date::parse($mk->tgl_ujian)->format('Y-m-d');
        }

        $matkul = $matkul->sortBy(function ($item) {
            return $item->tgl_ujian . '-' . $item->id_sesi;
        });

        $matkul->transform(function ($m) {
            $m->tgl_ujian = Date::parse($m->tgl_ujian)->format('d F Y');
            return $m;
        });

        $ruangan = Tr_Ruangan::with('ruangan')->where('kelas',$reqKelas)->firstOrFail();
        $tapel = Tahun_Pelajaran::first();
        $jadwal = Tr_Jadwal::firstOrFail();
        return view("pages.tamu.hasil", compact('matkul','ruangan','tapel','jadwal'));
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                "email" => "required",
                "password" => "required",
            ],
            [
                "email.required" => "Silakan masukan email Anda",
                "password.required" => "Password tidak boleh kosong",
            ]
        );

        // kredensial = memastikan email dan password benar
        $kredensial = $request->only("email", "password");

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->level=="pengawas") {
                Alert::success('Selamat, Anda berhasil masuk!');
                return redirect()->intended("jadwal");
            }elseif ($user->level=="keuangan") {
                Alert::success('Selamat, Anda berhasil masuk!');
                return redirect()->intended("verifikasi");
            } else {
                Alert::success('Selamat, Anda berhasil masuk!');
                return redirect()->intended("beranda");
            }

            return redirect()->intended("/home");
        }

        return back()
            ->withErrors([
                "email" => "Maaf email atau password Anda salah",
            ])
            ->onlyInput("email");
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::success('Selamat, Anda berhasil keluar!');

        return redirect('/')
            ->header('Cache-Control', 'no-store, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

}
