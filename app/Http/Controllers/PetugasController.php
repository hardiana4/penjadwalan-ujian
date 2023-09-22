<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Sesi;
use App\Models\Matakuliah;
use App\Models\Pengawas;
use App\Models\Tr_Matakuliah;
use App\Models\Tahun_Pelajaran;
use App\Models\Tr_Jadwal;
use App\Models\Tr_Ruangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    //Tahun Pelajaran
    public function tahun_pelajaran()
    {
        $user = Auth::User();
        $tahunpelajaran = Tahun_Pelajaran::find(1);
        $data = array
        (
            'tahun_pelajaran' => $tahunpelajaran
        );
        return view("pages.petugas.jadwal.tahunpelajaran.tahunpelajaran", ['type_menu' => ''], compact('user','tahunpelajaran'))->with([$data]);
    }

    public function update_tapel(Request $request, $id){
        $tahunpelajaran = Tahun_Pelajaran::first('id_tp',$id);

        $validator = Validator::make($request->all(), [
            'tahun_awal'    => 'required|numeric',
            'tahun_akhir'    => 'required|numeric|gt:tahun_awal',
        ],
        [
            'tahun_awal.required' => 'Mohon pilih terlebih dahulu!',
            'tahun_akhir.required' => 'Mohon pilih terlebih dahulu!',
            'tahun_akhir.gt' => 'Tahun akhir harus lebih besar dari tahun awal.',
        ]);

        if ($request->tahun_akhir - $request->tahun_awal > 1) {
        return redirect()->back()->withErrors('Selisih tahun antara tahun awal dan tahun akhir tidak boleh lebih dari 1 tahun.');
        }

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->tahun_awal === $request->tahun_akhir){
            return redirect()->back()->withErrors('Tahun awal dan tahun akhir tidak boleh sama.');
        }

        $tahunpelajaran->update([
            $tahunpelajaran->tahun_awal = $request->tahun_awal,
            $tahunpelajaran->tahun_akhir = $request->tahun_akhir,
            $tahunpelajaran->tahun_pelajaran = $request->tahun_awal.'/'.$request->tahun_akhir,
            ]);
        return redirect('/tahun-pelajaran')->with('success','Data tahun pelajaran berhasil diperbarui!');
    }

    //Matakuliah
    public function tr_matakuliahD3()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $tr_matakuliah = Tr_Matakuliah::with('pengawas','prodi','matkul','sesi')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D3');})->orderby('tgl_ujian')->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $dosen = Pengawas::with('detail')->where('jabatan','Dosen')->get();
        $data = array
        (
            'tr_matakuliah' => $tr_matakuliah
        );
        return view("pages.petugas.jadwal.matakuliah.D3.trmatakuliahD3", ['type_menu' => 'tr_matakuliah'], compact('user','tr_matakuliah','dosen'))->with([$data]);
    }

    public function tambah_trmatakuliahD3()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D3')->get();
        $sesi = Sesi::get();
        $pengampu = Pengawas::with('detail')->where('jabatan','=','Dosen')->get();
        $matkul = Matakuliah::select('id_matakuliah','matakuliah')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D3');})->get();
        $trmatakuliah = Tr_Matakuliah::all();
        return view("pages.petugas.jadwal.matakuliah.D3.tambah_trmatakuliahD3", ['type_menu' => 'tr_matakuliah'], compact('user','trmatakuliah','matkul','pengampu','prodi','sesi'));
    }

    public function create_trmatakuliahD3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_prodi'          => 'required',
            'kode_kelas'        => 'required',
            'id_matakuliah'          => 'required',
            'id_pengawas'          => 'required',
            'tgl_ujian'  => 'required',
            'id_sesi'             => 'required'
        ],
        [
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'kode_kelas.required' => 'Pilih kode kelas terlebih dahulu.',
            'id_matakuliah.required' => 'Pilih matakuliah terlebih dahulu.',
            'id_pengawas.required' => 'Pilih dosen pengampu terlebih dahulu.',
            'tgl_ujian.required' => 'Pilih tanggal ujian terlebih dahulu.',
            'id_sesi.required' => 'Pilih sesi terlebih dahulu.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $prodi = $request->id_prodi;
        $semester = $request->semester;
        $kode_kelas = $request->kode_kelas;

        $singkatan = Prodi::where('id_prodi',$prodi)->value('singkatan');
            if($semester=="I (Satu)"|| $semester=="II (Dua)"){
                $kelas_tingkat = $singkatan.".1";
            } elseif ($semester=="III (Tiga)"|| $semester=="IV (Empat)") {
                $kelas_tingkat = $singkatan.".2";
            } else {
                $kelas_tingkat = $singkatan.".3";
            }
        $idProdi = $request->input('id_prodi');
        $semester = $request->input('semester');
        $matakuliah = $request->input('id_matakuliah');

        $matkul = Matakuliah::where('id_matakuliah',$matakuliah)
                            ->value('matakuliah');
        $tgl = $request->input('tgl_ujian');
        $sesi = $request->input('id_sesi');
        $valSesi = Sesi::where('id_Sesi',$sesi)
                        ->value('sesi');
        $kodeKelasArray = $request->input('kode_kelas');
        $kelasMatkul = Tr_Matakuliah::where('id_prodi',$prodi)
                            ->where('semester',$semester)
                            ->whereIn('kode_kelas',$kode_kelas)
                            ->where('id_matakuliah',$matakuliah)
                            ->pluck('kelas')->toArray();
        $valKelasMatkul = implode(', ', $kelasMatkul);
        $kelasTglSesi = Tr_Matakuliah::where('id_prodi',$prodi)
                            ->where('semester',$semester)
                            ->whereIn('kode_kelas',$kode_kelas)
                            ->where('tgl_ujian',$tgl)
                            ->where('id_sesi',$sesi)
                            ->pluck('kelas')->toArray();
        $valKelasTglSesi = implode(', ', $kelasTglSesi);

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Matakuliah::where('id_prodi', $idProdi)
            ->where('semester', $semester)
            ->where('id_matakuliah', $matakuliah)
            ->whereIn('kode_kelas', $kodeKelasArray)
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors("Penjadwalan mata kuliah <strong>$matkul</strong> di kelas <strong>$valKelasMatkul</strong> sudah pernah diinput.");
        }

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Matakuliah::where('id_prodi', $idProdi)
            ->where('semester', $semester)
            ->where('tgl_ujian', $tgl)
            ->where('id_sesi', $sesi)
            ->whereIn('kode_kelas', $kodeKelasArray)
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors("Sudah ada ujian pada <strong>$tgl</strong> dan <strong>$valSesi </strong>di kelas <strong>$valKelasTglSesi</strong>.");
        }

        $smtJadwal = Tr_Matakuliah::pluck('semester')->first();
        if ($smtJadwal == "I (Satu)" || $smtJadwal == "III (Tiga)" || $smtJadwal == "V (Lima)") {
            $requestedSemester = $request->semester;
            if ($requestedSemester == "II (Dua)" || $requestedSemester == "IV (Empat)" || $requestedSemester == "VI (Enam)") {
                $errorMessage = "Saat ini Anda sedang menjadwalkan matakuliah ganjil. <br><strong>Hapus penjadwalan semester ganjil dahulu</strong> sebelum memulai menjadwalkan jadwal matakuliah semester genap.";
                return redirect('/penjadwalan-matakuliah-D3')->withErrors([$errorMessage]);
            }
        }

        $smtJadwal = Tr_Matakuliah::pluck('semester')->first();
        if ($smtJadwal == "II (Dua)" || $smtJadwal == "IV (Empat)" || $smtJadwal == "VI (Enam)") {
            $requestedSemester = $request->semester;
            if ($requestedSemester == "I (Satu)" || $requestedSemester == "III (Tiga)" || $requestedSemester == "V (Lima)") {
                $errorMessage = "Saat ini Anda sedang menjadwalkan matakuliah genap.  <br><strong>Hapus penjadwalan semester genap dahulu</strong> sebelum memulai menjadwalkan jadwal matakuliah semester ganjil.";
                return back()->withErrors([$errorMessage]);
            }
        }

        Date::setLocale('id');
        $kode_kelas = $request->input('kode_kelas');
        $hari = Date::createFromFormat('d M Y', $request->tgl_ujian)->format('l');
        foreach ($kode_kelas as $key => $kode) {
                    Tr_Matakuliah::create([
                        'id_prodi' => $request->id_prodi,
                        'semester' => $request->semester,
                        'kode_kelas' => $kode,
                        'kelas' => $kelas_tingkat.$kode,
                        'id_matakuliah' => $request->id_matakuliah,
                        'id_pengawas' => $request->id_pengawas,
                        'tgl_ujian' => $request->tgl_ujian,
                        'hari' => $hari,
                        'id_sesi' => $request->id_sesi,
                    ]);
                 }
        return redirect('/penjadwalan-matakuliah-D3')->with('success', 'Penjadwalan matakuliah berhasil ditambahkan.');
    }

    public function ubah_trmatakuliahD3($id)
    {
        $user = Auth::User();
        $tr_matakuliah = Tr_matakuliah::findOrFail($id);
        $sesi = Sesi::get();
        $pengampu = Pengawas::with('detail')->where('jabatan','=','Dosen')->get();
        return view("pages.petugas.jadwal.matakuliah.D3.ubah_trmatakuliahD3", ['type_menu' => 'tr_matakuliah'], compact('user','tr_matakuliah','pengampu','sesi'));
    }

    public function update_trmatakuliahD3(Request $request, $id)
    {
        $tr_matakuliah = Tr_Matakuliah::findOrFail($id);
        $request->validate([
            'id_pengawas'          => 'required',
            'tgl_ujian'         => 'required',
            'id_sesi'              => 'required',
        ],
        [
            'id_pengawas.required' => 'Mohon pilih terlebih dahulu.',
            'tgl_ujian.required'=> 'Mohon pilih terlebih dahulu.',
            'id_sesi.required'     => 'Mohon pilih terlebih dahulu.',
        ]);
        $hari = Date::createFromFormat('d M Y', $request->tgl_ujian)->format('l');

        $id = $tr_matakuliah->id; // ID yang sedang diperbarui
        $kelas = $request->input('kelas');
        $matakuliah = $request->input('id_matakuliah');

        // Mencari entri dengan kombinasi yang sama, kecuali ID yang sedang diperbarui
        $data = Tr_Matakuliah::where('kelas', $kelas)
            ->where('id_matakuliah', $matakuliah)
            ->where(function ($query) use ($id) {
                $query->where('id', '!=', $id) // Mengabaikan ID yang sedang diperbarui
                    ->orWhereNull('id'); // Mengabaikan entri yang belum memiliki ID
            })
            ->count();

        if ($data > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Data sudah pernah diinput');
        }

        $tgl = $request->input('tgl_ujian');
        $sesi = $request->input('id_sesi');
        $idPengawas = $request->input('id_pengawas');

        // Mencari entri dengan kombinasi yang sama, kecuali ID yang sedang diperbarui
        $count = Tr_Matakuliah::where('kelas', $kelas)
            ->where('tgl_ujian', $tgl)
            ->where('id_sesi', $sesi)
            ->where(function ($query) use ($id) {
                $query->where('id', '!=', $id) // Mengabaikan ID yang sedang diperbarui
                    ->orWhereNull('id'); // Mengabaikan entri yang belum memiliki ID
            })
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Sudah ada ujian pada tanggal dan sesi di kelas tersebut.');
        }

        $idLain = Tr_Matakuliah::where('id_pengawas', $idPengawas)
                                ->where('id_matakuliah', $matakuliah)
                                ->pluck('id');
        dd($idLain);

        $tr_matakuliah->update([
            'id_pengawas' => $request->id_pengawas,
            'tgl_ujian' => $request->tgl_ujian,
            'id_sesi' => $request->id_sesi,
            'hari' => $hari,
        ]);

        Tr_Matakuliah::whereIn('id', $idLain)->update([
            'tgl_ujian' => $request->tgl_ujian,
            'id_sesi' => $request->id_sesi,
            'hari' => $hari,
        ]);
        return redirect('/penjadwalan-matakuliah-D3')->with('success', 'Penjadwalan matakuliah berhasil diperbarui.');
    }

    public function hapus_trmatakuliahD3($id)
    {
        $tr_matakuliah = Tr_matakuliah::findOrFail($id);
        $tr_matakuliah->delete();
        return redirect('/penjadwalan-matakuliah-D3')->with('success','Penjadwalan matakuliah berhasil dihapus!');
    }

    public function hps_matkul(Request $request)
    {
        $idArray = $request->input('idnya');

        foreach ($idArray as $id) {
            $data = Tr_Matakuliah::find($id);

            if ($data) {
                $idTr = $data->id_trmatakuliah;
                $kelasMtk = $data->kelas;
                $kelas = Tr_Ruangan::where('kelas', $kelasMtk)->first();
                $jadwal = Tr_Jadwal::where('id_trmatakuliah', $idTr)->first();

                if ($kelas) {
                    $kelas->delete();
                }

                if ($jadwal) {
                    $idPengawas1 = $jadwal->id_pengawas1;
                    $idPengawas2 = $jadwal->id_pengawas2;
                    $kuota_p1 = Pengawas::where('id_pengawas', $idPengawas1)->value('kuota');
                    $kuota_p2 = Pengawas::where('id_pengawas', $idPengawas2)->value('kuota');

                    if ($kuota_p1 !== null && $kuota_p2 !== null) {
                        $kuota1 = ($kuota_p1 >= 3) ? 4 : ($kuota_p1 + 1);
                        $kuota2 = ($kuota_p2 >= 3) ? 4 : ($kuota_p2 + 1);

                        Pengawas::where('id_pengawas', $idPengawas1)->update(['kuota' => $kuota1]);
                        Pengawas::where('id_pengawas', $idPengawas2)->update(['kuota' => $kuota2]);
                    }
                }

                $data->delete();
            }
        }

        return redirect()->back()->with('success', 'Penjadwalan Matakuliah berhasil dihapus.');
    }

    public function tr_matakuliahD4()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $tr_matakuliah = Tr_Matakuliah::with('pengawas','prodi')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D4');})->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $dosen = Pengawas::with('detail')->where('jabatan','Dosen')->get();
        $data = array
        (
            'tr_matakuliah' => $tr_matakuliah
        );
        return view("pages.petugas.jadwal.matakuliah.D4.trmatakuliahD4", ['type_menu' => 'tr_matakuliah'], compact('user','tr_matakuliah','dosen'))->with([$data]);
    }

    public function tambah_trmatakuliahD4()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D4')->get();
        $pengampu = Pengawas::with('detail')->where('jabatan','=','Dosen')->get();
        $sesi = Sesi::get();
        $matkul = Matakuliah::select('id_matakuliah','matakuliah')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D4');})->get();
        $trmatakuliah = Tr_Matakuliah::all();
        return view("pages.petugas.jadwal.matakuliah.D4.tambah_trmatakuliahD4", ['type_menu' => 'tr_matakuliah'], compact('user','trmatakuliah','matkul','pengampu','prodi','sesi'));
    }

    public function create_trmatakuliahD4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_prodi'          => 'required',
            'kode_kelas'        => 'required',
            'id_matakuliah'          => 'required',
            'id_pengawas'          => 'required',
            'tgl_ujian'  => 'required',
            'id_sesi'             => 'required'
        ],
        [
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'kode_kelas.required' => 'Pilih kode kelas terlebih dahulu.',
            'id_matakuliah.required' => 'Pilih matakuliah terlebih dahulu.',
            'id_pengawas.required' => 'Pilih dosen pengampu terlebih dahulu.',
            'tgl_ujian.required' => 'Pilih tanggal ujian terlebih dahulu.',
            'id_sesi.required' => 'Pilih sesi terlebih dahulu.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $prodi = $request->id_prodi;
        $semester = $request->semester;
        $kode_kelas = $request->kode_kelas;

        $singkatan = Prodi::where('id_prodi',$prodi)->value('singkatan');
            if($semester=="I (Satu)"|| $semester=="II (Dua)"){
                $kelas_tingkat = $singkatan.".1";
            } elseif ($semester=="III (Tiga)"|| $semester=="IV (Empat)") {
                $kelas_tingkat = $singkatan.".2";
            } else {
                $kelas_tingkat = $singkatan.".3";
            }
        $idProdi = $request->input('id_prodi');
        $semester = $request->input('semester');
        $matakuliah = $request->input('id_matakuliah');

        $matkul = Matakuliah::where('id_matakuliah',$matakuliah)
                            ->value('matakuliah');
        $tgl = $request->input('tgl_ujian');
        $sesi = $request->input('id_sesi');
        $valSesi = Sesi::where('id_Sesi',$sesi)
                        ->value('sesi');
        $kodeKelasArray = $request->input('kode_kelas');
        $kelasMatkul = Tr_Matakuliah::where('id_prodi',$prodi)
                            ->where('semester',$semester)
                            ->whereIn('kode_kelas',$kode_kelas)
                            ->where('id_matakuliah',$matakuliah)
                            ->pluck('kelas')->toArray();
        $valKelasMatkul = implode(', ', $kelasMatkul);
        $kelasTglSesi = Tr_Matakuliah::where('id_prodi',$prodi)
                            ->where('semester',$semester)
                            ->whereIn('kode_kelas',$kode_kelas)
                            ->where('tgl_ujian',$tgl)
                            ->where('id_sesi',$sesi)
                            ->pluck('kelas')->toArray();
        $valKelasTglSesi = implode(', ', $kelasTglSesi);

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Matakuliah::where('id_prodi', $idProdi)
            ->where('semester', $semester)
            ->where('id_matakuliah', $matakuliah)
            ->whereIn('kode_kelas', $kodeKelasArray)
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors("Penjadwalan mata kuliah <strong>$matkul</strong> di kelas <strong>$valKelasMatkul</strong> sudah pernah diinput.");
        }

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Matakuliah::where('id_prodi', $idProdi)
            ->where('semester', $semester)
            ->where('tgl_ujian', $tgl)
            ->where('id_sesi', $sesi)
            ->whereIn('kode_kelas', $kodeKelasArray)
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors("Sudah ada ujian pada <strong>$tgl</strong> dan <strong>$valSesi </strong>di kelas <strong>$valKelasTglSesi</strong>.");
        }

        $smtJadwal = Tr_Matakuliah::pluck('semester')->first();
        if ($smtJadwal == "I (Satu)" || $smtJadwal == "III (Tiga)" || $smtJadwal == "V (Lima)" || $smtJadwal == "VII (Tujuh)") {
            $requestedSemester = $request->semester;
            if ($requestedSemester == "II (Dua)" || $requestedSemester == "IV (Empat)" || $requestedSemester == "VI (Enam)" || $requestedSemester == "VIII (Delapan)") {
                $errorMessage = "Saat ini Anda sedang menjadwalkan matakuliah ganjil. <br><strong>Hapus penjadwalan semester ganjil dahulu</strong> sebelum memulai menjadwalkan jadwal matakuliah semester genap.";
                return redirect('/penjadwalan-matakuliah-D4')->withErrors([$errorMessage]);
            }
        }

        $smtJadwal = Tr_Matakuliah::pluck('semester')->first();
        if ($smtJadwal == "II (Dua)" || $smtJadwal == "IV (Empat)" || $smtJadwal == "VI (Enam)") {
            $requestedSemester = $request->semester;
            if ($requestedSemester == "I (Satu)" || $requestedSemester == "III (Tiga)" || $requestedSemester == "V (Lima)") {
                $errorMessage = "Saat ini Anda sedang menjadwalkan matakuliah genap.  <br><strong>Hapus penjadwalan semester genap dahulu</strong> sebelum memulai menjadwalkan jadwal matakuliah semester ganjil.";
                return back()->withErrors([$errorMessage]);
            }
        }


        Date::setLocale('id');
        $kode_kelas = $request->input('kode_kelas');
        $hari = Date::createFromFormat('d M Y', $request->tgl_ujian)->format('l');
        foreach ($kode_kelas as $key => $kode) {
                    Tr_Matakuliah::create([
                        'id_prodi' => $request->id_prodi,
                        'semester' => $request->semester,
                        'kode_kelas' => $kode,
                        'kelas' => $kelas_tingkat.$kode,
                        'id_matakuliah' => $request->id_matakuliah,
                        'id_pengawas' => $request->id_pengawas,
                        'tgl_ujian' => $request->tgl_ujian,
                        'hari' => $hari,
                        'id_sesi' => $request->id_sesi,
                    ]);
                 }
        return redirect('/penjadwalan-matakuliah-D4')->with('success', 'Penjadwalan matakuliah berhasil ditambahkan.');
    }

    public function ubah_trmatakuliahD4($id)
    {
        $user = Auth::User();
        $tr_matakuliah = Tr_matakuliah::with('matkul')->findOrFail($id);
        $pengampu = Pengawas::with('detail')->where('jabatan','=','Dosen')->get();
        $sesi = Sesi::get();
        return view("pages.petugas.jadwal.matakuliah.D4.ubah_trmatakuliahD4", ['type_menu' => 'tr_matakuliah'], compact('user','tr_matakuliah','pengampu','sesi'));
    }

    public function update_trmatakuliahD4(Request $request, $id)
    {
        $tr_matakuliah = Tr_Matakuliah::findOrFail($id);
        $request->validate([
            'id_pengawas'          => 'required',
            'tgl_ujian'         => 'required',
            'id_sesi'              => 'required',
        ],
        [
            'id_pengawas.required' => 'Mohon pilih terlebih dahulu.',
            'tgl_ujian.required'=> 'Mohon pilih terlebih dahulu.',
            'id_sesi.required'     => 'Mohon pilih terlebih dahulu.',
        ]);

        $id = $tr_matakuliah->id_trmatakuliah; // ID yang sedang diperbarui
        $kelas = $request->input('kelas');
        $matakuliah = $request->input('id_matakuliah');

        // Mencari entri dengan kombinasi yang sama, kecuali ID yang sedang diperbarui
        $count = Tr_Matakuliah::where('kelas', $kelas)
            ->where('id_matakuliah', $matakuliah)
            ->where(function ($query) use ($id) {
                $query->where('id', '!=', $id) // Mengabaikan ID yang sedang diperbarui
                    ->orWhereNull('id'); // Mengabaikan entri yang belum memiliki ID
            })
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Data sudah pernah diinput');
        }

        $tgl = $request->input('tgl_ujian');
        $sesi = $request->input('id_sesi');

        // Mencari entri dengan kombinasi yang sama, kecuali ID yang sedang diperbarui
        $count = Tr_Matakuliah::where('kelas', $kelas)
            ->where('tgl_ujian', $tgl)
            ->where('id_sesi', $sesi)
            ->where(function ($query) use ($id) {
                $query->where('id', '!=', $id) // Mengabaikan ID yang sedang diperbarui
                    ->orWhereNull('id'); // Mengabaikan entri yang belum memiliki ID
            })
            ->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Sudah ada ujian pada tanggal dan sesi di kelas tersebut.');
        }


        $hari = Date::createFromFormat('d M Y', $request->tgl_ujian)->format('l');
        $tr_matakuliah->update([
        $tr_matakuliah->id_pengawas = $request->id_pengawas,
        $tr_matakuliah->tgl_ujian = $request->tgl_ujian,
        $tr_matakuliah->id_sesi = $request->id_sesi,
        $tr_matakuliah->hari = $hari,
        ]);
        return redirect('/penjadwalan-matakuliah-D4')->with('success', 'Penjadwalan matakuliah berhasil diperbarui.');
    }

    public function hapus_trmatakuliahD4($id)
    {
        $tr_matakuliah = Tr_matakuliah::findOrFail($id);
        $tr_matakuliah->delete();
        return redirect('/penjadwalan-matakuliah-D4')->with('success','Penjadwalan matakuliah berhasil dihapus!');
    }

    //Ruangan
    public function tr_ruangan()
    {
        $user = Auth::User();
        $ruangan = Tr_Ruangan::with('ruangan')->orderBy('created_at', 'DESC')->get();
        $data = array
        (
            'ruangan' => $ruangan
        );
        return view("pages.petugas.jadwal.ruangan.trruangan", ['type_menu' => ''], compact('user','ruangan'))->with([$data]);
    }

    public function hps_trruangan(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data ruangan
            $data = Tr_Ruangan::find($id[$i]);
            $data->delete();
        }
    }
    public function tambah_trruangan()
    {
        $user = Auth::User();
        return view("pages.petugas.jadwal.ruangan.tambah_trruangan", ['type_menu' => ''], compact('user'));
    }

    public function create_trruangan(Request $request)
    {
        $request->validate([
            'kelas'               => 'required',
            'id_ruangan'             => 'required'
        ],
        [
            'kelas.required' => 'Mohon pilih terlebih dahulu.',
            'id_ruangan.required' => 'Mohon pilih terlebih dahulu.',
        ]);

           $kelas = $request->input('kelas');

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Ruangan::where('kelas', $kelas)->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Data penjadwalan ruangan sudah pernah diinput');
        }

        Tr_ruangan::create([
                'kelas' => $request->kelas,
                'id_ruangan' => $request->id_ruangan
            ]);
        return redirect('/penjadwalan-ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function hapus_trruangan($id)
    {
        $tr_ruangan = Tr_ruangan::findOrFail($id);
        $tr_ruangan->delete();
        return redirect('/penjadwalan-ruangan')->with('success','Penjadwalan matakuliah berhasil dihapus!');
    }

    //UTS
    public function tr_UTS()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $tr_matakuliah = Tr_Matakuliah::with('pengawas','prodi','sesi')->get();
        $tr_jadwal = Tr_Jadwal::with('tapel','trmatakuliah','trruangan','pengawas1','pengawas2')
                                ->where('jenis','=','UTS')
                                ->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $dosen = Pengawas::with('detail')->where('jabatan','Dosen')->get();
        $data = array
        (
            'tr_matakuliah' => $tr_matakuliah
        );
        return view("pages.petugas.jadwal.ujian.UTS.truts", ['type_menu' => ''], compact('user','tr_matakuliah','dosen','tr_jadwal'))->with([$data]);
    }

    public function tambah_tr_UTS()
    {
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $kelas = Tr_Ruangan::pluck('kelas');
        $tapel = Tahun_Pelajaran::where('id_tp','1')->get();
        return view("pages.petugas.jadwal.ujian.UTS.tambah_truts", ['type_menu' => ''], compact('user','prodi','tapel','kelas'));
    }

    public function create_tr_UTS(Request $request)
    {
         $request->validate([
            'id_trmatakuliah'       => 'required',
            'id_trruangan'          => 'required',
            'id_pengawas1'          => 'required',
            'id_pengawas2'          => 'required'
        ],
        [
            'id_trmatakuliah.required'  => 'Mohon pilih terlebih dahulu.',
            'id_trruangan.required'     => 'Mohon pilih terlebih dahulu.',
            'id_pengawas1.required'     => 'Mohon pilih terlebih dahulu.',
            'id_pengawas2.required'     => 'Mohon pilih terlebih dahulu.'
        ]);

        $id_pengawas1 = $request->input('id_pengawas1');
        $id_pengawas2 = $request->input('id_pengawas2');
        $idPengawas1 = Pengawas::where('id_pengawas',$id_pengawas1)->value('kuota');
        $idPengawas2 = Pengawas::where('id_pengawas',$id_pengawas2)->value('kuota');

        if ($idPengawas1 == 4){
            $kuota1 = 3;
        } elseif ($idPengawas1 == 3){
            $kuota1 = 2;
        } elseif ($idPengawas1 == 2){
            $kuota1 = 1;
        } else {
            $kuota1 = 0;
        }

        if ($idPengawas2 == 4){
            $kuota2 = 3;
        } elseif ($idPengawas2 == 3){
            $kuota2 = 2;
        } elseif ($idPengawas2 == 2){
            $kuota2 = 1;
        } else {
            $kuota2 = 0;
        }

        $jenis = 'UTS';
        $kode = 'FM.PUTSUTS-C.03-R0';
        $id_tp = Tahun_Pelajaran::where('id_tp','1')->value('id_tp');

        $id_trmatakuliah = $request->input('id_trmatakuliah');

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Jadwal::where('id_trmatakuliah', $id_trmatakuliah)->where('jenis','=',$jenis)
                            ->count();

        if ($count > 0) {
         // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Data sudah pernah diinput');
        }

        $countUAS = Tr_Jadwal::where('jenis','UAS')->count();
        if ($countUAS > 0) {
            // Jika terdapat jenis UAS, kirimkan error
            return back()->withErrors("Anda masih mempunyai penjadwalan UAS, <strong>hapus semua penjadwalan UAS</strong> sebelum memulai penjadwalan UTS.");
        }

        Tr_Jadwal::create([
            'id_tp' => $id_tp,
            'id_trmatakuliah' => $request->id_trmatakuliah,
            'id_trruangan' => $request->id_trruangan,
            'id_pengawas1' => $request->id_pengawas1,
            'id_pengawas2' => $request->id_pengawas2,
            'jenis' => $jenis,
            'kode' => $kode
        ]);

        Pengawas::where('id_pengawas',$id_pengawas1)->update(['kuota' => $kuota1]);
        Pengawas::where('id_pengawas',$id_pengawas2)->update(['kuota' => $kuota2]);

        return redirect('/penjadwalan-ujian-tengah-semester')->with('success', 'Penjadwalan UTS berhasil ditambahkan.');
    }

    public function hps_uts(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data jadwal
            $data = Tr_Jadwal::find($id[$i]);
            $data->delete();
            $idPengawas1 = $data->id_pengawas1;
            $idPengawas2 = $data->id_pengawas2;

            $kuota_p1 = Pengawas::where('id_pengawas',$idPengawas1)->value('kuota');
            $kuota_p2 = Pengawas::where('id_pengawas',$idPengawas2)->value('kuota');

            if ($kuota_p1 == 3) {
                $kuota1 = 4;
            } elseif ($kuota_p1 == 2) {
                $kuota1 = 3;
            } elseif ($kuota_p1 == 1) {
                $kuota1 = 2;
            } elseif ($kuota_p1 == 0) {
                $kuota1 = 1;
            }

            if ($kuota_p2 == 3) {
                $kuota2 = 4;
            } elseif ($kuota_p2 == 2) {
                $kuota2 = 3;
            } elseif ($kuota_p2 == 1) {
                $kuota2 = 2;
            } elseif ($kuota_p2 == 0) {
                $kuota2 = 1;
            }

            // update kolom kuota
            Pengawas::where('id_pengawas',$idPengawas1)->update(['kuota' => $kuota1]);
            Pengawas::where('id_pengawas',$idPengawas2)->update(['kuota' => $kuota2]);
        }
    }

    //UAS
    public function tr_UAS()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $tr_matakuliah = Tr_Matakuliah::with('pengawas','prodi','sesi')->get();
        $tr_jadwal = Tr_Jadwal::with('tapel','trmatakuliah','trruangan','pengawas1','pengawas2')
                                ->where('jenis','=','UAS')
                                ->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $dosen = Pengawas::with('detail')->where('jabatan','Dosen')->get();
        $data = array
        (
            'tr_matakuliah' => $tr_matakuliah
        );
        return view("pages.petugas.jadwal.ujian.UAS.truas", ['type_menu' => ''], compact('user','tr_matakuliah','dosen','tr_jadwal'))->with([$data]);
    }

    public function tambah_tr_UAS()
    {
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $kelas = Tr_Ruangan::pluck('kelas');
        $tapel = Tahun_Pelajaran::where('id_tp','1')->get();
        return view("pages.petugas.jadwal.ujian.UAS.tambah_truas", ['type_menu' => ''], compact('user','prodi','tapel','kelas'));
    }

    public function create_tr_UAS(Request $request)
    {
         $request->validate([
            'id_trmatakuliah'       => 'required',
            'id_trruangan'          => 'required',
            'id_pengawas1'          => 'required',
            'id_pengawas2'          => 'required'
        ],
        [
            'id_trmatakuliah.required'  => 'Mohon pilih terlebih dahulu.',
            'id_trruangan.required'     => 'Mohon pilih terlebih dahulu.',
            'id_pengawas1.required'     => 'Mohon pilih terlebih dahulu.',
            'id_pengawas2.required'     => 'Mohon pilih terlebih dahulu.'
        ]);

        $id_pengawas1 = $request->input('id_pengawas1');
        $id_pengawas2 = $request->input('id_pengawas2');
        $idPengawas1 = Pengawas::where('id_pengawas',$id_pengawas1)->value('kuota');
        $idPengawas2 = Pengawas::where('id_pengawas',$id_pengawas2)->value('kuota');

        if ($idPengawas1 == 4){
            $kuota1 = 3;
        } elseif ($idPengawas1 == 3){
            $kuota1 = 2;
        } elseif ($idPengawas1 == 2){
            $kuota1 = 1;
        } else {
            $kuota1 = 0;
        }

        if ($idPengawas2 == 4){
            $kuota2 = 3;
        } elseif ($idPengawas2 == 3){
            $kuota2 = 2;
        } elseif ($idPengawas2 == 2){
            $kuota2 = 1;
        } else {
            $kuota2 = 0;
        }

        $jenis = 'UAS';
        $kode = 'FM.PUTSUAS-C.03-R0';
        $id_tp = Tahun_Pelajaran::where('id_tp','1')->value('id_tp');

        $id_trmatakuliah = $request->input('id_trmatakuliah');

        // Mencari entri dengan kombinasi yang sama
        $count = Tr_Jadwal::where('id_trmatakuliah', $id_trmatakuliah)->where('jenis','=',$jenis)->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors('Data sudah pernah diinput');
        }

        $countUTS = Tr_Jadwal::where('jenis','UTS')->count();
        if ($countUTS > 0) {
            // Jika terdapat jenis UTS, kirimkan error
            return back()->withErrors("Anda masih mempunyai penjadwalan UTS, <strong>hapus semua penjadwalan UTS</strong> sebelum memulai penjadwalan UAS.");
        }

        Tr_Jadwal::create([
            'id_tp' => $id_tp,
            'id_trmatakuliah' => $request->id_trmatakuliah,
            'id_trruangan' => $request->id_trruangan,
            'id_pengawas1' => $request->id_pengawas1,
            'id_pengawas2' => $request->id_pengawas2,
            'jenis' => $jenis,
            'kode' => $kode
        ]);

        Pengawas::where('id_pengawas',$id_pengawas1)->update(['kuota' => $kuota1]);
        Pengawas::where('id_pengawas',$id_pengawas2)->update(['kuota' => $kuota2]);

        return redirect('/penjadwalan-ujian-akhir-semester')->with('success', 'Penjadwalan UAS berhasil ditambahkan.');
    }

    public function hps_uas(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data jadwal
            $data = Tr_Jadwal::find($id[$i]);
            $data->delete();

            $idPengawas1 = $data->id_pengawas1;
            $idPengawas2 = $data->id_pengawas2;

            $kuota_p1 = Pengawas::where('id_pengawas',$idPengawas1)->value('kuota');
            $kuota_p2 = Pengawas::where('id_pengawas',$idPengawas2)->value('kuota');

            if ($kuota_p1 == 3) {
                $kuota1 = 4;
            } elseif ($kuota_p1 == 2) {
                $kuota1 = 3;
            } elseif ($kuota_p1 == 1) {
                $kuota1 = 2;
            } elseif ($kuota_p1 == 0) {
                $kuota1 = 1;
            }

            if ($kuota_p2 == 3) {
                $kuota2 = 4;
            } elseif ($kuota_p2 == 2) {
                $kuota2 = 3;
            } elseif ($kuota_p2 == 1) {
                $kuota2 = 2;
            } elseif ($kuota_p2 == 0) {
                $kuota2 = 1;
            }

            // update kolom kuota
            Pengawas::where('id_pengawas',$idPengawas1)->update(['kuota' => $kuota1]);
            Pengawas::where('id_pengawas',$idPengawas2)->update(['kuota' => $kuota2]);
        }
    }

   public function total()
    {
        $user = Auth::user();
        $pengawas = Pengawas::with('detail')->distinct('id_pengawas')->get();
        $idPengawas = Pengawas::with('detail')->distinct('id_pengawas')->pluck('id_pengawas');

        $countPengawas = []; // Array untuk menyimpan jumlah pengawas berdasarkan masing-masing id

        foreach ($idPengawas as $id) {
            $count = Tr_Jadwal::where('id_pengawas1', $id)->orWhere('id_pengawas2', $id)->count();
            $countPengawas[$id] = $count;
        }

        $tr_jadwal = Tr_Jadwal::with('trmatakuliah', 'trruangan')
            ->where(function ($query) use ($idPengawas) {
                $query->whereIn('id_pengawas1', $idPengawas)
                    ->orWhereIn('id_pengawas2', $idPengawas);
            })
            ->get();

        $data = array(
            'pengawas' => $pengawas
        );

        return view("pages.petugas.jadwal.ujian.total", ['type_menu' => ''], compact('user', 'pengawas', 'countPengawas', 'tr_jadwal'))->with([$data]);
    }

    public function hps_jadwal(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data jadwal
            $data = Tr_Jadwal::find($id[$i]);
            $data->delete();

            $idPengawas1 = $data->id_pengawas1;
            $idPengawas2 = $data->id_pengawas2;

            $kuota_p1 = User::where('id',$idPengawas1)->value('kuota');
            $kuota_p2 = User::where('id',$idPengawas2)->value('kuota');

            if ($kuota_p1 == 3) {
                $kuota1 = 4;
            } elseif ($kuota_p1 == 2) {
                $kuota1 = 3;
            } elseif ($kuota_p1 == 1) {
                $kuota1 = 2;
            } else {
                $kuota1 = 1;
            }

            if ($kuota_p2 == 3) {
                $kuota2 = 4;
            } elseif ($kuota_p2 == 2) {
                $kuota2 = 3;
            } elseif ($kuota_p2 == 1) {
                $kuota2 = 2;
            } else {
                $kuota2 = 1;
            }

            // update kolom kuota
            User::where('id',$idPengawas1)->update(['kuota' => $kuota1]);
            User::where('id',$idPengawas2)->update(['kuota' => $kuota2]);
        }
    }

    //Cetak
    public function cetak_ganjil()
    {
        $user = Auth::User();
        $tgl = Tr_Matakuliah::distinct('tgl_ujian')->select('tgl_ujian', 'hari')->orderby('tgl_ujian')->get();
        $sesi = Sesi::all();
        $prodi = Prodi::all();
        return view("pages.petugas.hasil.ganjil.cetak_ganjil", ['type_menu' => ''], compact('user','tgl','prodi','sesi'));
    }

    public function cetak_genap()
    {
        $user = Auth::User();
        $tgl = Tr_Matakuliah::distinct('tgl_ujian')->select('tgl_ujian', 'hari')->get();
        $sesi = Sesi::all();
        $prodi = Prodi::all();
        return view("pages.petugas.hasil.genap.cetak_genap", ['type_menu' => 'cetak'], compact('user','tgl','prodi','sesi'));
    }

    public function cetak_jadwalProdi_uts()
    {
        $user = Auth::User();
        return view("pages.petugas.hasil.jadwal.jprodi_uts", ['type_menu' => ''], compact('user'));
    }
}
