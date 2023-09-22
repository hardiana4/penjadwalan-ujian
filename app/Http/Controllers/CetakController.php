<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Ketua;
use App\Models\Sesi;
use App\Models\Tahun_Pelajaran;
use App\Models\Tr_Jadwal;
use App\Models\Tr_Matakuliah;
use App\Models\Tr_Ruangan;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;

class CetakController extends Controller
{
    public function cetakProdi(Request $request)
    {
        $user = Auth::User();
        $validator = Validator::make($request->all(), [
            'id_prodi'      => 'required',
        ],
        [
            'id_prodi.required' => 'Pilih terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        $prodi = $request->input('id_prodi');
        $mhs = Mahasiswa::with('prodi','user')
                        ->where('id_prodi','=',$prodi)->where('status','=','1')->get();

        $tapel = Tahun_Pelajaran::first();
        $jadwal = Tr_Jadwal::firstOrFail();

        $dataMahasiswa = [];
        foreach ($mhs as $m) {
            $kelas = $m->kelas;

            $ruangan = Tr_Ruangan::with('ruangan')
                ->where('kelas', '=', $kelas)
                ->first();

            $matkul = Tr_Matakuliah::with('matkul', 'sesi')
                ->where('kelas', '=', $kelas)
                ->where('semester',$m->semester)
                ->orderBy('tgl_ujian')
                ->orderBy('id_sesi')
                ->get();


            $dataMahasiswa[] = [
            'mahasiswa' => $m,
            'ruangan' => $ruangan,
            'matkul' => $matkul,
            'jadwal' => $jadwal,
            ];

        }
        $ketua = Ketua::with('user')
                ->where('ketua.id_ketua','1')
                ->first();

        return view("pages.Admin.Hasil.KartuUjian.Cetak.cetakProdi", ['type_menu' => ''], compact('user','ketua','dataMahasiswa','tapel'));
    }

    public function cetakKelas(Request $request)
    {
        $user = Auth::User();
        $validator = Validator::make($request->all(), [
            'kelas'      => 'required',
        ],
        [
            'kelas.required' => 'Pilih kelas terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $tapel = Tahun_Pelajaran::first();
        $jadwal = Tr_Jadwal::firstOrFail();

        $kelas = $request->input('kelas');
        $mhs = Mahasiswa::with('prodi','user')
                        ->where('kelas','=',$kelas)->where('status','=','1')->get();
        $m = Mahasiswa::with('prodi','user')
                                ->where('kelas','=',$kelas)->where('status','=','1')->first();
        $ruangan = Tr_Ruangan::with('ruangan')->where('kelas','=',$kelas)->first();
        $matkul = Tr_Matakuliah::with('matkul','sesi')->where('kelas','=',$kelas)->where('semester',$m->semester)->orderBy('tgl_ujian')->orderby('id_sesi')->get();
        $ketua = Ketua::with('user')
                ->where('ketua.id_ketua','1')
                ->first();
        return view("pages.Admin.Hasil.KartuUjian.Cetak.cetakKelas", ['type_menu' => ''], compact('user','ketua','mhs','ruangan','matkul','tapel','jadwal'));
    }

    public function cetakMhs(Request $request )
    {
    $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'idMhs'      => 'required',
        ],
        [
            'idMhs.required' => 'Pilih mahasiswa terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

    $idMhs = $request->input('idMhs');
    $mhs = Mahasiswa::with('prodi','user')
                    ->where('id_mahasiswa','=',$idMhs)
                    ->first();
    $kls = Mahasiswa::with('prodi','user')
                    ->where('id_mahasiswa','=',$idMhs)
                    ->pluck('kelas');
    $kelas = Tr_Ruangan::where('kelas','=',$kls)->pluck('kelas')->first();
    $ruangan = Tr_Ruangan::with('ruangan')->where('kelas','=',$kelas)->first();
        // dd($ruangan);
    Date::setLocale('id');

    $matkul = Tr_Matakuliah::with('matkul','sesi')->where('kelas','=',$kelas)->where('semester',$mhs->semester)->orderBy('tgl_ujian')->orderby('id_sesi')->get();
    $tapel = Tahun_Pelajaran::first();
    $jadwal = Tr_Jadwal::firstOrFail();

    $ketua = Ketua::with('user')
                ->where('ketua.id_ketua','1')
                ->first();
    return view('pages.Admin.Hasil.KartuUjian.Cetak.cetakMhs', compact('user','ketua','mhs','ruangan','matkul','jadwal','tapel'));
    }

    public function cetak()
    {
        $user = Auth::User();
        $tgl = Tr_Matakuliah::select('tgl_ujian', 'hari')->distinct('tgl_ujian')->orderBy('tgl_ujian')->get();
        // $tgl = Tr_Jadwal::whereHas('trmatakuliah', function ($query) {
        //                     $query->select('tgl_ujian', 'hari')
        //                         ->distinct('tgl_ujian')
        //                         ->orderBy('tgl_ujian');
        //                 })
        //                 ->get();
                        // dd($tgl);
        $sesi = Sesi::all();
        $prodi = Prodi::all();
        return view("pages.petugas.hasil.cetak", ['type_menu' => ''], compact('user','tgl','prodi','sesi'));
    }

    public function cetakBerkas(Request $request)
    {
        $user = Auth::User();
        $validator = Validator::make($request->all(), [
            'tgl_ujian'      => 'required',
            'id_sesi'      => 'required',
        ],
        [
            'tgl_ujian.required' => 'Pilih tanggal ujian terlebih dahulu.',
            'id_sesi.required' => 'Pilih sesi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $tgl = $request->input('tgl_ujian');
        $sesi = $request->input('id_sesi');
        $tglsesi = Tr_Matakuliah::where('tgl_ujian','=', $tgl)->where('id_sesi','=',$sesi)->get('id_trmatakuliah');
        $tapel = Tahun_Pelajaran::first();
        $jadwal = Tr_Jadwal::firstorFail();
        $ruangan = Tr_Jadwal::with('trmatakuliah','pengawas1','pengawas2','trruangan')->whereIn('id_trmatakuliah',$tglsesi)->get();
        $data = Tr_Jadwal::with('trmatakuliah','pengawas1','pengawas2')->whereIn('id_trmatakuliah',$tglsesi)->firstOrFail();

        return view("pages.petugas.hasil.berkas.berkas", ['type_menu' => ''], compact('user','sesi','ruangan','data','tapel','jadwal'));
    }

    public function cetakJadwal(Request $request)
    {
        $user = Auth::User();
        $validator = Validator::make($request->all(), [
            'prodi'      => 'required',
        ],
        [
            'prodi.required' => 'Pilih prodi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $prodi = $request->input('prodi');
        $jurusan = Prodi::where('id_prodi',$prodi)->first();

        //Data pada tabel
       $datakelas1 = Tr_Matakuliah::select('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->where('id_prodi', '=', $prodi)
                    ->whereIn('semester', ['I (Satu)', 'II (Dua)'])
                    ->groupBy('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->orderBy('tgl_ujian')
                    ->orderBy('id_sesi')
                    ->get();
        $datakelas2 = Tr_Matakuliah::select('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->where('id_prodi', '=', $prodi)
                    ->whereIn('semester', ['III (Tiga)', 'IV (Empat)'])
                    ->groupBy('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->orderBy('tgl_ujian')
                    ->orderBy('id_sesi')
                    ->get();
        $datakelas3 = Tr_Matakuliah::select('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->where('id_prodi', '=', $prodi)
                    ->whereIn('semester', ['V (Lima)', 'VI (Enam)'])
                    ->groupBy('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->get();
        $datakelas4 = Tr_Matakuliah::select('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->where('id_prodi', '=', $prodi)
                    ->whereIn('semester', ['VII (Tujuh)', 'VIII (Delapan)'])
                    ->groupBy('semester','hari', 'tgl_ujian', 'id_sesi', 'id_matakuliah')
                    ->orderBy('tgl_ujian')
                    ->orderBy('id_sesi')
                    ->get();

        foreach ($datakelas1 as $data1) {
            $data1->tgl_ujian = Date::parse($data1->tgl_ujian)->format('Y-m-d');
        }

        $datakelas1 = $datakelas1->sortBy(function ($item) {
            return $item->tgl_ujian . '-' . $item->id_sesi;
        });

        foreach ($datakelas2 as $data2) {
            $data2->tgl_ujian = Date::parse($data2->tgl_ujian)->format('Y-m-d');
        }

        $datakelas2 = $datakelas2->sortBy(function ($item) {
            return $item->tgl_ujian . '-' . $item->id_sesi;
        });

        foreach ($datakelas3 as $data3) {
            $data3->tgl_ujian = Date::parse($data3->tgl_ujian)->format('Y-m-d');
        }

        $datakelas3 = $datakelas3->sortBy(function ($item) {
            return $item->tgl_ujian . '-' . $item->id_sesi;
        });

        foreach ($datakelas4 as $data4) {
            $data4->tgl_ujian = Date::parse($data4->tgl_ujian)->format('Y-m-d');
        }

        $datakelas4 = $datakelas4->sortBy(function ($item) {
            return $item->tgl_ujian . '-' . $item->id_sesi;
        });

        $datakelas1->transform(function ($data1) {
            $data1->tgl_ujian = Date::parse($data1->tgl_ujian)->format('d-M-y');
            return $data1;
        });

        $datakelas2->transform(function ($data2) {
            $data2->tgl_ujian = Date::parse($data2->tgl_ujian)->format('d-M-y');
            return $data2;
        });

        $datakelas3->transform(function ($data3) {
            $data3->tgl_ujian = Date::parse($data3->tgl_ujian)->format('d-M-y');
            return $data3;
        });

        $datakelas4->transform(function ($data4) {
            $data4->tgl_ujian = Date::parse($data4->tgl_ujian)->format('d-M-y');
            return $data4;
        });

        $idKelas1 = $datakelas1->pluck('id_trmatakuliah');
        $idKelas2 = $datakelas2->pluck('id_trmatakuliah');
        $idKelas3 = $datakelas3->pluck('id_trmatakuliah');
        $idKelas4 = $datakelas4->pluck('id_trmatakuliah');

        $semuaIdKelas = $idKelas1->merge($idKelas2)->merge($idKelas3)->merge($idKelas4);

        //Mengambil value kelas
        $kelas1 = Tr_Matakuliah::where('id_prodi','=', $prodi)->whereIn('semester', ['I (Satu)', 'II (Dua)'])->distinct('kelas')->pluck('kelas');
        $kelas2 = Tr_Matakuliah::where('id_prodi','=',$prodi)->whereIn('semester', ['III (Tiga)', 'IV (Empat)'])->distinct('kelas')->pluck('kelas');
        $kelas3 = Tr_Matakuliah::where('id_prodi','=',$prodi)->whereIn('semester', ['V (Lima)', 'VI (Enam)'])->distinct('kelas')->pluck('kelas');
        $kelas4 = Tr_Matakuliah::where('id_prodi','=',$prodi)->whereIn('semester', ['VII (Tujuh)', 'VIII (Delapan)'])->distinct('kelas')->pluck('kelas');

        //Mengambil value ruangan
       $ruang1 = Tr_Ruangan::join('ruangan', 'tr_ruangan.id_ruangan', '=', 'ruangan.id_ruangan')
            ->select('ruangan.ruangan')
            ->whereIn('kelas', $kelas1)
            ->pluck('ruangan.ruangan');

        $ruang2 = Tr_Ruangan::join('ruangan', 'tr_ruangan.id_ruangan', '=', 'ruangan.id_ruangan')
            ->select('ruangan.ruangan')
            ->whereIn('kelas', $kelas2)
            ->pluck('ruangan.ruangan');

        $ruang3 = Tr_Ruangan::join('ruangan', 'tr_ruangan.id_ruangan', '=', 'ruangan.id_ruangan')
            ->select('ruangan.ruangan')
            ->whereIn('kelas', $kelas3)
            ->pluck('ruangan.ruangan');

        $ruang4 = Tr_Ruangan::join('ruangan', 'tr_ruangan.id_ruangan', '=', 'ruangan.id_ruangan')
            ->select('ruangan.ruangan')
            ->whereIn('kelas', $kelas4)
            ->pluck('ruangan.ruangan');

        $smt1 = $datakelas1->first();
        $smt2 = $datakelas2->first();
        $smt3 = $datakelas3->first();
        $smt4 = $datakelas4->first();
        $tapel = Tahun_Pelajaran::first();
        $jadwal = Tr_Jadwal::firstorFail();
        $ketua = Ketua::with('user')
                ->where('ketua.id_ketua','1')
                ->first();
        return view("pages.petugas.hasil.jadwal.jprodi", ['type_menu' => ''], compact('user','datakelas1','datakelas2',
                                                                                     'datakelas3','datakelas4','kelas1',
                                                                                     'kelas2','kelas3','kelas4','ruang1',
                                                                                     'ruang2','ruang3','ruang4','jadwal',
                                                                                    'tapel','smt1','smt2','smt3','smt4','ketua','jurusan'));
    }




}
