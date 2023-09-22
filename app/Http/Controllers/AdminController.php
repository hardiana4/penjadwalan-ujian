<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Sesi;
use App\Models\Gedung;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\Detail;
use App\Models\Pengawas;
use App\Models\Ketua;
use App\Models\Tr_Matakuliah;
use App\Models\Tr_Jadwal;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Prodi
    public function prodi()
    {
        $user = Auth::User();
        $prodi = Prodi::orderBy('created_at', 'DESC')->get();
        $data = array
        (
            'prodi' => $prodi
        );
        return view("pages.admin.kelola.prodi.prodi", ['type_menu' => ''], compact('user','prodi'))->with([$data]);
    }

    public function tambah_prodi()
    {
        $user = Auth::User();
        $prodi = Prodi::all();
        return view("pages.admin.kelola.prodi.tambah_prodi", ['type_menu' => ''], compact('user','prodi'));
    }

    public function create_prodi(Request $request)
    {
        $prodi = ($request->jenjang)." ".($request->nama_prodi);

        $validator = Validator::make($request->all(), [
            'nama_prodi'            => 'required|unique:prodi,nama_prodi|regex:/^[^0-9]*$/',
            'singkatan'             => 'required|unique:prodi,singkatan|regex:/^[^0-9]*$/',
        ],
        [
            'nama_prodi.required'   => 'Nama prodi tidak boleh kosong.',
            'nama_prodi.regex'   => 'Nama prodi tidak boleh berisi angka.',
            'nama_prodi.unique'     => 'Nama Prodi sudah ada, coba yang lain.',
            'singkatan.unique'     => 'Singkatan sudah ada, coba yang lain.',
            'singkatan.regex'     => 'Singkatan tidak boleh berisi angka.',
            'singkatan.required'    => 'Singkatan tidak boleh kosong.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

            Prodi::create([
            'jenjang' => $request->jenjang,
            'nama_prodi' => $request->nama_prodi,
            'prodi' => $prodi,
            'singkatan' => $request->singkatan,
        ]);
        return redirect('/prodi')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function ubah_prodi($id)
    {
        $user = Auth::User();
        $prodi = Prodi::findOrFail($id);
        return view("pages.admin.kelola.prodi.ubah_prodi", ['type_menu' => ''], compact('user','prodi'));
    }

    public function update_prodi(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_prodi'      => 'required|unique:prodi,nama_prodi,'. $prodi->id_prodi.',id_prodi',
            'singkatan'      => 'required|unique:prodi,singkatan,'. $prodi->id_prodi.',id_prodi',
        ],
        [
            'nama_prodi.required' => 'Nama prodi tidak boleh kosong.',
            'nama_prodi.unique' => 'Nama prodi sudah ada, coba yang lain.',
            'singkatan.required' => 'Singkatan tidak boleh kosong.',
            'singkatan.unique' => 'Singkatan sudah ada, coba yang lain.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $prodibaru = ($request->jenjang)." ".($request->nama_prodi);

        $prodi->update([
        'jenjang' => $request->jenjang,
        'nama_prodi' => $request->nama_prodi,
        'prodi' => $prodibaru,
        'singkatan' => $request->singkatan,
        ]);

        return redirect('/prodi')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function hapus_prodi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();
        return redirect('/prodi')->with('success','Prodi berhasil dihapus!');
    }

    //Pengguna
    //Pengawas
    public function pengawas(){
        $user = Auth::User();
        $pengawas = Pengawas::with('prodi','users','detail')->whereHas('users', function ($query) {
                                                            $query->where('level', 'pengawas');})->orderBy('created_at', 'DESC')->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $data = array
        (
            'user' => $pengawas
        );
        return view("pages.admin.kelola.pengguna.pengawas.pengawas", ['type_menu' => 'pengguna'], compact('user','pengawas','prodi'))->with([$data]);
    }

    public function tambah_pengawas()
    {
        $user = Auth::User();
        $pengawas = User::where("level","pengawas")->with('detail','pengawas')->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        return view("pages.admin.kelola.pengguna.pengawas.tambah_pengawas", ['type_menu' => 'pengguna'], compact('user','prodi','pengawas'));
    }

    public function create_pengawas(Request $request)
    {
        $password = "Abcd1234*";
        $level = "pengawas";

        $validator = Validator::make($request->all(), [
            'nama'       => 'required|regex:/^[^0-9]*$/',
            'email'       => 'required|email|unique:users,email',
            'id_prodi'       => 'required',
        ],
        [
            'nama.required' => 'Nama pengawas tidak boleh kosong.',
            'nama.regex' => 'Nama pengawas tidak boleh berisi angka.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Harus diisi dengan email.',
            'email.unique' => 'Email sudah ada, coba yang lain.',
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($password),
                'level' => $level,
            ]);

            $detail = Detail::create([
                'id_users' => $user->id_users,
                'nama' => $request->nama,
            ]);

            Pengawas::create([
                'id_users' => $user->id_users,
                'id_detail' => $detail->id_detail,
                'id_prodi' => $request->id_prodi,
                'jabatan' => $request->jabatan,
                'kuota' => $request->kuota,
            ]);

        return redirect('/pengawas')->with('success', 'Pengawas berhasil ditambahkan.');
    }

    public function ubah_pengawas($id)
    {
        $user = Auth::user();
        $pengawas = Pengawas::findOrFail($id);
        $prodi = Prodi::all();
        return view("pages.admin.kelola.pengguna.pengawas.ubah_pengawas", ['type_menu' => 'pengguna'], compact('user','pengawas','prodi'));
    }

    public function update_pengawas(Request $request, $id)
    {
        $pengawas = Pengawas::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $pengawas->users->id_users . ',id_users',
            'id_prodi' => 'required',
        ], [
            'nama.required' => 'Nama pengawas tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Harus diisi dengan email.',
            'email.unique' => 'Email sudah ada, coba yang lain.',
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $countPengawas = Tr_Jadwal::where('id_pengawas1', $pengawas->id_pengawas)->orWhere('id_pengawas2', $pengawas->id_pengawas)->count();

        // Pemeriksaan apakah ada data di tabel tr_jadwal
        if ($countPengawas > 0) {
            // Jika ada data di tabel tr_jadwal, maka kolom "kuota" tidak diupdate
            $pengawas->detail->nama = $request->nama;
            $pengawas->users->email = $request->email;
            $pengawas->id_prodi = $request->id_prodi;
            $pengawas->jabatan = $request->jabatan;
            $pengawas->push();

            return redirect('/pengawas')->with('success', 'Pengawas berhasil diperbarui.')->with('warning', "Kuota tidak dapat diperbarui karena pengawas sedang dijadwalkan.");
        } else {
            // Jika tidak ada data di tabel tr_jadwal, maka bisa melakukan update kuota
            $pengawas->detail->nama = $request->nama;
            $pengawas->users->email = $request->email;
            $pengawas->id_prodi = $request->id_prodi;
            $pengawas->jabatan = $request->jabatan;
            $pengawas->kuota = $request->kuota;
            $pengawas->push();

            return redirect('/pengawas')->with('success', 'Pengawas berhasil diperbarui.');
        }



    }


    public function hapus_pengawas($id)
    {
        $pengawas = Pengawas::findOrFail($id);
        $users = User::where('id_users',$pengawas->id_users);
        $detail = Detail::where('id_detail',$pengawas->id_detail);
        $users->delete();
        $detail->delete();
        $pengawas->delete();
        return redirect('/pengawas')->with('success','Pengawas berhasil dihapus!');
    }

    public function hps_pengawas(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Pengawas::find($id[$i]);
            $data->delete();
        }
    }

    public function petugas()
    {
        $user = Auth::User();
        $petugas = User::with('detail')->where("level","petugas")->orWhere("level", "keuangan")->get();
        $data = array
        (
            'user' => $petugas
        );
        return view("pages.admin.kelola.pengguna.petugas.petugas", ['type_menu' => 'pengguna'], compact('user','petugas'))->with([$data]);
    }

    //Mahasiswa
    public function mahasiswaD3()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $mahasiswa = Mahasiswa::with('user','prodi')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang' ,'D3');})->orderBy('created_at', 'DESC')->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $dosen = Pengawas::where('jabatan','Dosen')->get();
        $data = array
        (
            'mahasiswa' => $mahasiswa
        );
        return view("pages.admin.kelola.mahasiswa.D3.mahasiswaD3", ['type_menu' => 'mahasiswa'], compact('user','mahasiswa','prodi','dosen'))->with([$data]);
    }

    public function dosen($id)
    {
        $dosens = DB::table("pengawas")
                ->join('detail', 'pengawas.id_detail', '=', 'detail.id_detail')
                ->where('pengawas.id_prodi', $id)
                ->where('pengawas.jabatan', 'Dosen')
                ->pluck('detail.nama', 'pengawas.id_pengawas');
        return json_encode($dosens);
    }

    public function tambah_mahasiswaD3()
    {
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D3')->get();
        $dosen = Pengawas::where('jabatan','Dosen')->get();
        $mahasiswa = Mahasiswa::all();
        return view("pages.admin.kelola.mahasiswa.D3.tambah_mahasiswaD3", ['type_menu' => 'mahasiswa'], compact('user','prodi','dosen','mahasiswa'));
    }

    public function hps_semesterd3(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Mahasiswa::find($id[$i]);
            $data->delete();
        }
    }

    public function hps_semesterd4(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Mahasiswa::find($id[$i]);
            $data->delete();
        }
    }

    public function naik_semesterd3(Request $request)
    {
        $id = $request->idnya;
        $count = count($id);
        $Satu = "I (Satu)";
        $Dua = "II (Dua)";
        $Tiga = "III (Tiga)";
        $Empat = "IV (Empat)";
        $Lima = "V (Lima)";
        $Enam = "VI (Enam)";
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Mahasiswa::find($id[$i]);
            // check enum
            if ($data->semester === $Satu) {
                $dt = [
                    'semester' => $Dua
                ];
                $data->update($dt);
            }elseif ($data->semester === $Dua) {
                $data = Mahasiswa::find($id[$i]);
                $singkatan = Prodi::where('id_prodi',$data->id_prodi)->value('singkatan');
                $kode_kelas = Mahasiswa::where('id_mahasiswa',$data->id_mahasiswa)->value('kode_kelas');
                $kelas = $singkatan.'.2'.$kode_kelas;
                $dt = [
                    'semester' => $Tiga,
                    'kelas' => $kelas,
                ];
                $data->update($dt);
            }elseif ($data->semester === $Tiga) {
                $dt = [
                    'semester' => $Empat
                ];
                $data->update($dt);
            }elseif ($data->semester === $Empat) {
                $data = Mahasiswa::find($id[$i]);
                $singkatan = Prodi::where('id_prodi',$data->id_prodi)->value('singkatan');
                $kode_kelas = Mahasiswa::where('id_mahasiswa',$data->id_mahasiswa)->value('kode_kelas');
                $kelas = $singkatan.'.3'.$kode_kelas;
                $dt = [
                    'semester' => $Lima,
                    'kelas' => $kelas,
                ];
                $data->update($dt);
            }elseif ($data->semester == $Lima) {
                $dt = [
                    'semester' => $Enam
                ];
                $data->update($dt);
            }elseif ($data->semester == $Enam) {
                $data->delete();
            }
        }
    }

    public function naik_semesterd4(Request $request)
    {
        $id = $request->idnya;
        $count = count($id);
        $Satu = "I (Satu)";
        $Dua = "II (Dua)";
        $Tiga = "III (Tiga)";
        $Empat = "IV (Empat)";
        $Lima = "V (Lima)";
        $Enam = "VI (Enam)";
        $Tujuh = "VII (Tujuh)";
        $Delapan = "VIII (Delapan)";
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Mahasiswa::find($id[$i]);
            // check enum
            if ($data->semester === $Satu) {
                $dt = [
                    'semester' => $Dua
                ];
                $data->update($dt);
            }elseif ($data->semester === $Dua) {
                $data = Mahasiswa::find($id[$i]);
                $singkatan = Prodi::where('id_prodi',$data->id_prodi)->value('singkatan');
                $kode_kelas = Mahasiswa::where('id_mahasiswa',$data->id_mahasiswa)->value('kode_kelas');
                $kelas = $singkatan.'.2'.$kode_kelas;
                $dt = [
                    'semester' => $Tiga,
                    'kelas' => $kelas,
                ];
                $data->update($dt);
            }elseif ($data->semester === $Tiga) {
                $dt = [
                    'semester' => $Empat
                ];
                $data->update($dt);
            }elseif ($data->semester === $Empat) {
                $data = Mahasiswa::find($id[$i]);
                $singkatan = Prodi::where('id_prodi',$data->id_prodi)->value('singkatan');
                $kode_kelas = Mahasiswa::where('id_mahasiswa',$data->id_mahasiswa)->value('kode_kelas');
                $kelas = $singkatan.'.3'.$kode_kelas;
                $dt = [
                    'semester' => $Lima,
                    'kelas' => $kelas,
                ];
                $data->update($dt);
            }elseif ($data->semester == $Lima) {
                $dt = [
                    'semester' => $Enam
                ];
                $data->update($dt);
            }elseif ($data->semester == $Enam) {
                $data = Mahasiswa::find($id[$i]);
                $singkatan = Prodi::where('id_prodi',$data->id_prodi)->value('singkatan');
                $kode_kelas = Mahasiswa::where('id_mahasiswa',$data->id_mahasiswa)->value('kode_kelas');
                $kelas = $singkatan.'.4'.$kode_kelas;
                $dt = [
                    'semester' => $Tujuh,
                    'kelas' => $kelas,
                ];
                $data->update($dt);
            }elseif ($data->semester == $Tujuh) {
                $dt = [
                    'semester' => $Delapan
                ];
                $data->update($dt);
            }elseif ($data->semester == $Delapan) {
                $data->delete();
            }
        }
    }

    public function create_mahasiswaD3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_prodi'          => 'required',
            'semester'          => 'required',
            'kode_kelas'        => 'required',
            'id_pengawas'          => 'required',
            'nama_mahasiswa.*'  => 'required|regex:/^[^0-9]*$/',
            'npm.*'             => [
                                    'required',
                                    'unique:mahasiswa,npm',
                                    'distinct',
                                    ],
        ],
        [
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'semester.required' => 'Pilih semester terlebih dahulu.',
            'kode_kelas.required' => 'Pilih kode kelas terlebih dahulu.',
            'id_pengawas.required' => 'Pilih dosen wali terlebih dahulu.',
            'nama_mahasiswa.*.required' => 'Nama tidak boleh kosong.',
            'nama_mahasiswa.*.regex' => 'Nama tidak boleh berisi angka.',
            'npm.*.required' => 'NPM tidak boleh kosong.',
            'npm.*.unique' => 'NPM sudah ada, cek kembali.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $nama_mahasiswa = $request->input('nama_mahasiswa');
        $npm = $request->input('npm');
        $status = '1';
        $prodi = $request->id_prodi;
        $semester = $request->semester;
        $kode_kelas = $request->kode_kelas;
        $singkatan = Prodi::where('id_prodi',$prodi)->value('singkatan');
            if($semester=="I (Satu)"|| $semester=="II (Dua)"){
                $kelas = $singkatan.".1".$kode_kelas;
            } elseif ($semester=="III (Tiga)"|| $semester=="IV (Empat)") {
                $kelas = $singkatan.".2".$kode_kelas;
            } else {
                $kelas = $singkatan.".3".$kode_kelas;
            }
            foreach ($nama_mahasiswa as $key => $nama) {
                    Mahasiswa::create([
                        'id_prodi' => $prodi,
                        'semester' => $semester,
                        'kode_kelas' => $kode_kelas,
                        'kelas' => $kelas,
                        'id_pengawas' => $request->id_pengawas,
                        'nama_mahasiswa' => $nama,
                        'status' => $status,
                        'npm'  => $npm[$key],
                    ]);
                 }
        return redirect('/mahasiswa-D3')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function ubah_mahasiswaD3($id)
    {
        $user = Auth::User();
        $mahasiswa = Mahasiswa::findOrFail($id);
        $semester = Mahasiswa::all();
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D3')->pluck('prodi','id_prodi');
        $pengawas = Pengawas::with('detail')->where('jabatan','=','Dosen')->get();
        return view("pages.admin.kelola.mahasiswa.D3.ubah_mahasiswaD3", ['type_menu' => 'mahasiswa'], compact('user','mahasiswa','prodi','pengawas','semester'));
    }

    public function update_mahasiswaD3(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $semester = $request->semester;
        $kode_kelas = $request->kode_kelas;
        $prodi = $request->id_prodi;
        $singkatan = Prodi::where('id_prodi',$prodi)->value('singkatan');

        if($semester=="I (Satu)"|| $semester=="II (Dua)"){
                $kelas = $singkatan.".1".$kode_kelas;
            } elseif ($semester=="III (Tiga)"|| $semester=="IV (Empat)") {
                $kelas = $singkatan.".2".$kode_kelas;
            } else {
                $kelas = $singkatan.".3".$kode_kelas;
            }

        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required|regex:/^[^0-9]*$/',
            'npm'            => 'required|numeric|unique:mahasiswa,npm,'. $mahasiswa->id_mahasiswa.',id_mahasiswa',
            'id_prodi'       => 'required',
            'id_pengawas'    => 'required',
        ],
        [
            'nama_mahasiswa.required' => 'Nama mahasiswa tidak boleh kosong.',
            'nama_mahasiswa.regex' => 'Nama mahasiswa tidak boleh berisi angka.',
            'npm.required' => 'NPM tidak boleh kosong.',
            'npm.numeric' => 'NPM hanya boleh berisi angka.',
            'npm.unique' => 'NPM sudah ada, coba yang lain.',
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'id_pengawas.required' => 'Pilih dosen wali terlebih dahulu.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswa->update([
            $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa,
            $mahasiswa->id_prodi = $prodi,
            $mahasiswa->semester = $request->semester,
            $mahasiswa->kode_kelas = $kode_kelas,
            $mahasiswa->kelas = $kelas,
            $mahasiswa->id_pengawas = $request->id_pengawas,
            $mahasiswa->npm = $request->npm,
            ]);
            return redirect('/mahasiswa-D3')->with('success', 'Mahasiswa berhasil diperbarui.');
        }

    public function hapus_mahasiswaD3($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect('/mahasiswa-D3')->with('success','Mahasiswa berhasil dihapus!');
    }

    //D3
    public function mahasiswaD4()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $mahasiswa = Mahasiswa::with('user','prodi')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D4');})->orderBy('created_at', 'DESC')->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $dosen = Pengawas::where('jabatan','Dosen')->get();
        $data = array
        (
            'mahasiswa' => $mahasiswa
        );
        return view("pages.admin.kelola.mahasiswa.D4.mahasiswaD4", ['type_menu' => 'mahasiswa'], compact('user','mahasiswa','prodi','dosen'))->with([$data]);
    }

    public function tambah_mahasiswaD4()
    {
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D4')->get();
        $dosen = Pengawas::where('jabatan','Dosen')->get();
        $mahasiswa = Mahasiswa::all();
        return view("pages.admin.kelola.mahasiswa.D4.tambah_mahasiswaD4", ['type_menu' => 'mahasiswa'], compact('user','prodi','dosen','mahasiswa'));
    }

    public function create_mahasiswaD4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_prodi'          => 'required',
            'semester'          => 'required',
            'kode_kelas'        => 'required',
            'id_pengawas'          => 'required',
            'nama_mahasiswa.*'  => 'required|regex:/^[^0-9]*$/',
            'npm.*'             => [
                                    'required',
                                    'unique:mahasiswa,npm',
                                    'distinct',
                                    ],
        ],
        [
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'semester.required' => 'Pilih semester terlebih dahulu.',
            'kode_kelas.required' => 'Pilih kode kelas terlebih dahulu.',
            'id_pengawas.required' => 'Pilih dosen wali terlebih dahulu.',
            'nama_mahasiswa.*.required' => 'Nama tidak boleh kosong.',
            'nama_mahasiswa.*.regex' => 'Nama tidak boleh berisi angka.',
            'npm.*.required' => 'NPM tidak boleh kosong.',
            'npm.*.unique' => 'NPM sudah ada, cek kembali.',
        ]);


        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $nama_mahasiswa = $request->input('nama_mahasiswa');
        $npm = $request->input('npm');
        $status = '1';
        $semester = $request->semester;
        $kode_kelas = $request->kode_kelas;
        $prodi = $request->id_prodi;
        $singkatan = Prodi::where('id_prodi',$prodi)->value('singkatan');

            if($semester=="I (Satu)"|| $semester=="II (Dua)"){
                $kelas = $singkatan.".1".$kode_kelas;
            } elseif ($semester=="III (Tiga)"|| $semester=="IV (Empat)") {
                $kelas = $singkatan.".2".$kode_kelas;
            } elseif ($semester=="V (Lima)"|| $semester=="VI (Enam)") {
                $kelas = $singkatan.".3".$kode_kelas;
            } else {
                $kelas = $singkatan.".4".$kode_kelas;
            }

            foreach ($nama_mahasiswa as $key => $nama) {
                    Mahasiswa::create([
                        'id_prodi' => $prodi,
                        'semester' => $semester,
                        'kode_kelas' => $kode_kelas,
                        'kelas' => $kelas,
                        'id_pengawas' => $request->id_pengawas,
                        'nama_mahasiswa' => $nama,
                        'status' => $status,
                        'npm'  => $npm[$key],
                    ]);
                 }
        // dd($request->all());
        return redirect('/mahasiswa-D4')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function ubah_mahasiswaD4($id)
    {
        $user = Auth::User();
        $mahasiswa = Mahasiswa::findOrFail($id);
        $semester = Mahasiswa::all();
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D4')->pluck('prodi','id_prodi');
        $pengawas = Pengawas::with('detail')->where('jabatan','=','Dosen')->get();
        return view("pages.admin.kelola.mahasiswa.D4.ubah_mahasiswaD4", ['type_menu' => 'mahasiswa'], compact('user','mahasiswa','prodi','pengawas','semester'));
    }

    public function update_mahasiswaD4(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $semester = $request->semester;
        $kode_kelas = $request->kode_kelas;
        $prodi = $request->id_prodi;
        $singkatan = Prodi::where('id_prodi',$prodi)->value('singkatan');
            if($semester=="I (Satu)"|| $semester=="II (Dua)"){
                $kelas = $singkatan.".1".$kode_kelas;
            } elseif ($semester=="III (Tiga)"|| $semester=="IV (Empat)") {
                $kelas = $singkatan.".2".$kode_kelas;
            } elseif ($semester=="V (Lima)"|| $semester=="VI (Enam)") {
                $kelas = $singkatan.".".$kode_kelas;
            } else {
                $kelas = $singkatan.".4".$kode_kelas;
            }

        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required|regex:/^[^0-9]*$/',
            'npm'            => 'required|numeric|unique:mahasiswa,npm,'. $mahasiswa->id_mahasiswa.',id_mahasiswa',
            'id_prodi'       => 'required',
            'id_pengawas'       => 'required',
        ],
        [
            'nama_mahasiswa.required' => 'Nama mahasiswa tidak boleh kosong.',
            'nama_mahasiswa.regex' => 'Nama mahasiswa tidak boleh berisi angka.',
            'npm.required' => 'NPM tidak boleh kosong.',
            'npm.numeric' => 'NPM hanya boleh berisi angka.',
            'npm.unique' => 'NPM sudah ada, coba yang lain.',
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'id_pengawas.required' => 'Pilih dosen wali terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswa->update([
            $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa,
            $mahasiswa->npm = $request->npm,
            $mahasiswa->id_prodi = $prodi,
            $mahasiswa->semester = $request->semester,
            $mahasiswa->kode_kelas = $kode_kelas,
            $mahasiswa->kelas = $kelas,
            $mahasiswa->id_pengawas = $request->id_pengawas,
            ]);
            // dd($request->all());
            return redirect('/mahasiswa-D4')->with('success', 'Mahasiswa berhasil diperbarui.');
        }

    public function hapus_mahasiswaD4($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect('/mahasiswa-D4')->with('success','Mahasiswa berhasil dihapus!');
    }

    //Ketua Panitia
    public function ketua_panitia()
    {
        $user = Auth::User();
        $ketua = Ketua::with('user')
                ->where('ketua.id_ketua','1')
                ->first();
        $dosen = User::with('detail')->where('level','=','pengawas')->get();
        return view("pages.admin.pelaksanaan.KetuaPanitia.ketua", ['type_menu' => ''], compact('user','ketua','dosen'));
    }

    public function update_ketua(Request $request, $id){
        $ketua = Ketua::first('id_ketua',$id);

        $validator = Validator::make($request->all(), [
            'id_users'          => 'required',
            'nip'               => 'required|numeric',
            'tgl'               => 'required',
        ],
        [
            'id_users.required' => 'Pilih ketua terlebih dahulu.',
            'nip.required'      => 'NIP tidak boleh kosong.',
            'nip.numeric'      => 'NIP hanya berisi angka.',
            'tgl.required'      => 'Pilih tanggal terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $tgl = $request->tgl;
        $tgl_sah = "Cilacap, ".$tgl;

        $ketua->update([
            $ketua->id_users = $request->id_users,
            $ketua->nip = $request->nip,
            $ketua->tgl = $tgl,
            $ketua->tgl_sah = $tgl_sah,
            ]);
        return redirect('ketua-panitia')->with('success','Data Ketua berhasil diperbarui');
    }

    public function update_ttd(Request $request, $id){
        $ketua = Ketua::where('id_ketua',$id)->first();

        $validator = Validator::make($request->all(), [
            'ttd'    => 'required|mimes:png,jpg,jpeg',
        ],
        [
            'ttd.required' => 'Mohon pilih terlebih dahulu!',
            'ttd.mimes' => 'Format yang diijinkan hanya png, jpg, dan jpeg!',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $oldTTD = $ketua->ttd;
        $pathTTD = public_path('img/ketua/' . $oldTTD);

        if ($request->hasFile('ttd'))
        {
            @unlink($pathTTD);

            $ttd = $request->file('ttd');
            $ttd_ext = $ttd->getClientOriginalExtension();
            $newTTD = 'ketua'  . '.' . $ttd_ext;
            $pathTTD = 'img/ketua/';
            $ttd->move($pathTTD, $newTTD);
            $ketua->ttd = $newTTD;
        }
        $ketua->update();
        return redirect('ketua-panitia')->with('success','Data Ketua berhasil diperbarui');
    }

    //sesi
    public function sesi()
    {
        $user = Auth::User();
        $sesi = Sesi::get();
        $data = array
        (
            'sesi' => $sesi
        );
        return view("pages.admin.pelaksanaan.sesi.sesi", ['type_menu' => ''], compact('user','sesi'))->with([$data]);
    }

    public function tambah_sesi()
    {
        $user = Auth::User();
        return view("pages.admin.pelaksanaan.sesi.tambah_sesi", ['type_menu' => ''], compact('user'));
    }

    public function create_sesi(Request $request)
        {
            $validator = Validator::make($request->all(), [
               'urutan'       => 'required|unique:sesi,urutan',
               'waktu_awal'       => 'required',
               'waktu_akhir'       => 'required',
            ],
            [
                'urutan.required' => 'Urutan tidak boleh kosong.',
                'urutan.unique' => 'Urutan sudah ada, coba yang lain.',
                'waktu_awal.required' => 'Waktu mulai tidak boleh kosong.',
                'waktu_akhir.required' => 'Waktu akhir tidak boleh kosong.',
            ]);


            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }

        $awal = Sesi::pluck('waktu_awal')->toArray();
        $akhir = Sesi::pluck('waktu_akhir')->toArray();
        $waktuAwal = $request->input('waktu_awal');
        $waktuAkhir = $request->input('waktu_akhir');
        if ($waktuAwal > $waktuAkhir) {
            return redirect()->back()->withInput()->withErrors('Waktu mulai tidak boleh lebih dari waktu selesai.');
        }

        // Validasi waktu awal tidak sama dengan waktu akhir
        if ($waktuAwal == $waktuAkhir) {
            return redirect()->back()->withInput()->withErrors('Waktu mulai tidak boleh sama dengan waktu selesai.');
        }

       $tabrakan = false;

        foreach ($awal as $index => $start) {
            $end = $akhir[$index];
            if (($waktuAwal >= $start && $waktuAwal <= $end) || ($waktuAkhir >= $start && $waktuAkhir <= $end) || ($waktuAwal >= $start && $waktuAkhir <= $end)) {
                $tabrakan = true;
                break;
            }

            if (($start >= $waktuAwal && $start <= $waktuAkhir) || ($end >= $waktuAwal && $end <= $waktuAkhir)) {
                $tabrakan = true;
                break;
            }
        }


        if ($tabrakan) {
            return redirect()->back()->withInput()->withErrors('Sudah ada sesi dalam rentang waktu tersebut.');
        }

        // Simpan data sesi ke database
        Sesi::create([
            'urutan' => $request->urutan,
            'waktu_awal' => $waktuAwal,
            'waktu_akhir' => $waktuAkhir,
            'sesi' => $waktuAwal.' - '.$waktuAkhir,
        ]);

        return redirect('/sesi')->with('success', 'Sesi berhasil ditambahkan.');
    }

    public function ubah_sesi($id)
    {
        $user = Auth::User();
        $sesi = Sesi::findOrFail($id);
        $sesi->select('sesi');
        return view("pages.admin.pelaksanaan.sesi.ubah_sesi", ['type_menu' => ''], compact('user','sesi'));
    }

    public function update_sesi(Request $request, $id)
    {
        $sesi = Sesi::findOrFail($id);
        $validator = Validator::make($request->all(), [
               'urutan'       => 'required|unique:sesi,urutan,'. $sesi->id_sesi.',id_sesi',
               'waktu_awal'       => 'required',
               'waktu_akhir'       => 'required',
            ],
            [
                'urutan.required' => 'Urutan tidak boleh kosong.',
                'urutan.unique' => 'Urutan sudah ada, coba yang lain.',
                'waktu_awal.required' => 'Waktu mulai tidak boleh kosong.',
                'waktu_akhir.required' => 'Waktu akhir tidak boleh kosong.',
            ]);

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }

        $awal = Sesi::whereNotIn('id_sesi',$sesi)->pluck('waktu_awal')->toArray();
        $akhir = Sesi::whereNotIn('id_sesi',$sesi)->pluck('waktu_akhir')->toArray();
        $waktuAwal = $request->input('waktu_awal');
        $waktuAkhir = $request->input('waktu_akhir');
        if ($waktuAwal > $waktuAkhir) {
            return redirect()->back()->withInput()->withErrors('Waktu mulai tidak boleh lebih dari waktu selesai.');
        }

        // Validasi waktu awal tidak sama dengan waktu akhir
        if ($waktuAwal == $waktuAkhir) {
            return redirect()->back()->withInput()->withErrors('Waktu mulai tidak boleh sama dengan waktu selesai.');
        }

       $tabrakan = false;

        foreach ($awal as $index => $start) {
            $end = $akhir[$index];
            if (($waktuAwal >= $start && $waktuAwal <= $end) || ($waktuAkhir >= $start && $waktuAkhir <= $end) || ($waktuAwal >= $start && $waktuAkhir <= $end)) {
                $tabrakan = true;
                break;
            }

            if (($start >= $waktuAwal && $start <= $waktuAkhir) || ($end >= $waktuAwal && $end <= $waktuAkhir)) {
                $tabrakan = true;
                break;
    }
        }

        if ($tabrakan) {
            return redirect()->back()->withInput()->withErrors('Sudah ada sesi dalam rentang waktu tersebut.');
        }

        // if ($waktuAkhir >= $awal && $waktuAkhir <= $akhir) {
        //     return redirect()->back()->withInput()->withErrors('Sudah ada sesi dalam rentang waktu tersebut.');
        // }

        $sesi->update([
            $sesi->urutan = $request->urutan,
            $sesi->waktu_awal = $waktuAwal,
            $sesi->waktu_akhir = $waktuAkhir,
            $sesi->sesi = $waktuAwal.' - '.$waktuAkhir,
            ]);
        return redirect('/sesi')->with('success', 'Sesi berhasil diperbarui.');
    }

    public function hapus_sesi($id)
    {
        $sesi = sesi::findOrFail($id);
        $sesi->delete();
        return redirect('/sesi')->with('success','Sesi berhasil dihapus!');
    }

    //Gedung
    public function gedung()
    {
        $user = Auth::User();
        $gedung = Gedung::orderBy('created_at', 'DESC')->get();
        $data = array
        (
            'gedung' => $gedung
        );
        return view("pages.admin.pelaksanaan.gedung.gedung", ['type_menu' => ''], compact('user','gedung'))->with([$data]);
    }

    public function tambah_gedung()
    {
        $user = Auth::User();
        return view("pages.admin.pelaksanaan.gedung.tambah_gedung", ['type_menu' => ''], compact('user'));
    }

    public function create_gedung(Request $request)
        {
            $validator = Validator::make($request->all(), [
               'gedung'       => 'required|unique:gedung,gedung|regex:/^[^0-9]*$/',
               'singkat'       => 'required|unique:gedung,singkat|regex:/^[^0-9]*$/',
            ],
            [
                'gedung.required' => 'Nama gedung tidak boleh kosong.',
                'gedung.regex' => 'Nama gedung tidak boleh berisi angka.',
                'gedung.unique' => 'Nama gedung sudah ada, coba yang lain.',
                'singkat.required' => 'Singkatan tidak boleh kosong.',
                'singkat.unique' => 'Singkatan sudah ada, coba yang lain.',
                'singkat.regex' => 'Singkatan tidak boleh berisi angka.',
            ]);

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }
                gedung::create([
                'gedung' => $request->gedung,
                'singkat' => $request->singkat,
            ]);
            return redirect('/gedung')->with('success', 'Gedung berhasil ditambahkan.');
        }

    public function ubah_gedung($id)
    {
        $user = Auth::User();
        $gedung = gedung::findOrFail($id);
        $gedung->select('gedung');
        return view("pages.admin.pelaksanaan.gedung.ubah_gedung", ['type_menu' => ''], compact('user','gedung'));
    }

    public function update_gedung(Request $request, $id)
    {
        $gedung = gedung::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'gedung'       => 'required|unique:gedung,gedung,'. $gedung->id_gedung.',id_gedung',
            'singkat'       => 'required|unique:gedung,singkat,'. $gedung->id_gedung.',id_gedung',
        ],
        [
            'gedung.required' => 'Nama gedung tidak boleh kosong.',
            'gedung.unique' => 'Nama gedung sudah ada, coba yang lain.',
            'singkat.required' => 'Singkatan tidak boleh kosong.',
            'singkat.unique' => 'Singkatan sudah ada, coba yang lain.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $gedung->update([
            $gedung->gedung = $request->gedung,
            $gedung->singkat = $request->singkat,
            ]);
        return redirect('/gedung')->with('success', 'Gedung berhasil diperbarui.');
    }

    public function hapus_gedung($id)
    {
        $gedung = gedung::findOrFail($id);
        $gedung->delete();
        return redirect('/gedung')->with('success','Gedung berhasil dihapus!');
    }

    //Ruangan
    public function ruangan()
    {
        $user = Auth::User();
        $ruangan = Ruangan::with('gedung')->orderBy('created_at', 'DESC')->get();
        $gedung = Gedung::get();
        $data = array
        (
            'ruangan' => $ruangan
        );
        return view("pages.admin.pelaksanaan.ruangan.ruangan", ['type_menu' => ''], compact('user','ruangan','gedung'))->with([$data]);
    }

    public function tambah_ruangan()
    {
        $user = Auth::User();
        $gedung = Gedung::get();
        return view("pages.admin.pelaksanaan.ruangan.tambah_ruangan", ['type_menu' => ''], compact('user','gedung'));
    }

    public function create_ruangan(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'id_gedung'       => 'required',
               'ruangan'       => 'required|unique:ruangan,ruangan',
            ],
            [
                'id_gedung.required' => 'Pilih gedung terlebih dahulu.',
                'ruangan.required' => 'Nama Ruangan tidak boleh kosong.',
                'ruangan.unique' => 'Nama ruangan sudah ada, coba yang lain.',
            ]);

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }
                Ruangan::create([
                'id_gedung' => $request->id_gedung,
                'ruangan' => $request->ruangan,
            ]);
            return redirect('/ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
        }

    public function ubah_ruangan($id)
    {
        $user = Auth::User();
        $ruangan = Ruangan::findOrFail($id);
        $gedung = Gedung::all();
        return view("pages.admin.pelaksanaan.ruangan.ubah_ruangan", ['type_menu' => ''], compact('user','gedung','ruangan'));
    }

    public function update_ruangan(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'ruangan'       => 'required|unique:ruangan,ruangan,'. $ruangan->id_ruangan.',id_ruangan',
        ],
        [
            'ruangan.required' => 'Ruangan tidak boleh kosong.',
            'ruangan.unique' => 'Nama ruangan sudah ada, coba yang lain.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $ruangan->update([
            $ruangan->id_gedung = $request->id_gedung,
            $ruangan->ruangan = $request->ruangan,
            ]);
        return redirect('/ruangan')->with('success', 'Ruangan berhasil diperbarui.');
    }

     public function hps_ruangan(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data ruangan
            $data = Ruangan::find($id[$i]);
            $data->delete();
        }
    }

    //Matakuliah
    public function matakuliahD3()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $matakuliah = Matakuliah::with('user','prodi')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D3');})->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $data = array
        (
            'matakuliah' => $matakuliah
        );
        return view("pages.admin.pelaksanaan.matakuliah.D3.matakuliahD3", ['type_menu' => 'matakuliah'], compact('user','prodi','matakuliah'))->with([$data]);
    }

    public function tambah_matakuliahD3()
    {
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D3')->get();
        $matakuliah = Matakuliah::all();
        return view("pages.admin.pelaksanaan.matakuliah.D3.tambah_matakuliahD3", ['type_menu' => 'matakuliah'], compact('user','prodi','matakuliah'));
    }

    public function create_matakuliahD3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_prodi'          => 'required',
            'matakuliah.*'      => 'required',

        ],
        [
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'matakuliah.*.required' => 'Matakuliah tidak boleh kosong.',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $matakuliah = $request->input('matakuliah');
            foreach ($matakuliah as $key => $mk) {
                    matakuliah::create([
                        'id_prodi' => $request->id_prodi,
                        'semester' => $request->semester,
                        'matakuliah' => $mk,
                    ]);
                 }
        // dd($request->all());
        return redirect('/matakuliah-D3')->with('success', 'Matakuliah berhasil ditambahkan.');
    }

    public function ubah_matakuliahD3($id)
    {
        $user = Auth::User();
        $matakuliah = Matakuliah::findOrFail($id);
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D3')->pluck('prodi','id_prodi');
        $dosen = User::all()->where('jabatan','Dosen');
        return view("pages.admin.pelaksanaan.matakuliah.D3.ubah_matakuliahD3", ['type_menu' => 'matakuliah'], compact('user','matakuliah','prodi','dosen'));
    }

    public function update_matakuliahD3(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $prodi = $request->id_prodi;
        $semester = $request->semester;

        $validator = Validator::make($request->all(), [
            'id_prodi'       => 'required',
            'semester'       => 'required',
            'matakuliah'      => 'required',
        ],
        [
            'id_prodi.required' => 'Mohon isi terlebih dahulu.',
            'semester.required' => 'Mohon isi terlebih dahulu.',
            'matakuliah.required' => 'Mohon isi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $matakuliah->update([
        $matakuliah->id_prodi = $request->id_prodi,
        $matakuliah->semester = $request->semester,
        $matakuliah->matakuliah = $request->matakuliah,
        ]);
        return redirect('/matakuliah-D3')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function hps_matakuliah(Request $request){
        $id = $request->idnya;
        $count = count($id);
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data matakuliah
            $data = Matakuliah::find($id[$i]);
            $data->delete();
        }
    }

    public function hapus_matakuliahD3($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $count = Tr_Matakuliah::where('id_matakuliah',$id)->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors("Matakuliah sedang dijadwalkan.");
        } else {
            $matakuliah->delete();
            return redirect('/matakuliah-D3')->with('success','Matakuliah berhasil dihapus!');
        }

    }

    public function matakuliahD4()
    {
        $user = Auth::User();
        $id_prodi = Prodi::find('id_prodi');
        $matakuliah = Matakuliah::with('user','prodi')->whereHas('prodi', function ($q) use ($id_prodi) {
                     $q->where('jenjang','D4');})->get();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $data = array
        (
            'matakuliah' => $matakuliah
        );
        return view("pages.admin.pelaksanaan.matakuliah.D4.matakuliahD4", ['type_menu' => 'matakuliah'], compact('user','prodi','matakuliah'))->with([$data]);
    }

    public function tambah_matakuliahD4()
    {
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D4')->get();
        $matakuliah = Matakuliah::all();
        return view("pages.admin.pelaksanaan.matakuliah.D4.tambah_matakuliahD4", ['type_menu' => 'matakuliah'], compact('user','prodi','matakuliah'));
    }

    public function create_matakuliahD4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_prodi'          => 'required',
            'semester'          => 'required',
            'matakuliah.*'      => 'required',

        ],
        [
            'id_prodi.required' => 'Pilih prodi terlebih dahulu.',
            'semester.required' => 'Mohon isi terlebih dahulu.',
            'matakuliah.*.required' => 'Mohon isi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $matakuliah = $request->input('matakuliah');
            foreach ($matakuliah as $key => $mk) {
                    matakuliah::create([
                        'id_prodi' => $request->id_prodi,
                        'semester' => $request->semester,
                        'matakuliah' => $mk,
                    ]);
                 }
        // dd($request->all());
        return redirect('/matakuliah-D4')->with('success', 'Matakuliah berhasil ditambahkan.');
    }

    public function ubah_matakuliahD4($id)
    {
        $user = Auth::User();
        $matakuliah = Matakuliah::findOrFail($id);
        $prodi = Prodi::select('id_prodi','prodi')->where('jenjang','D4')->pluck('prodi','id_prodi');
        $dosen = User::all()->where('jabatan','Dosen');
        return view("pages.admin.pelaksanaan.matakuliah.D4.ubah_matakuliahD4", ['type_menu' => 'matakuliah'], compact('user','matakuliah','prodi','dosen'));
    }

    public function update_matakuliahD4(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $prodi = $request->id_prodi;
        $semester = $request->semester;

        $validator = Validator::make($request->all(), [
            'id_prodi'       => 'required',
            'semester'       => 'required',
            'matakuliah'      => 'required',
        ],
        [
            'id_prodi.required' => 'Mohon isi terlebih dahulu.',
            'semester.required' => 'Mohon isi terlebih dahulu.',
            'matakuliah.required' => 'Mohon isi terlebih dahulu.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $matakuliah->update([
        $matakuliah->id_prodi = $request->id_prodi,
        $matakuliah->semester = $request->semester,
        $matakuliah->matakuliah = $request->matakuliah,
        ]);
        return redirect('/matakuliah-D4')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function hapus_matakuliahD4($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $count = Tr_Matakuliah::where('id_matakuliah',$id)->count();

        if ($count > 0) {
            // Jika terdapat entri yang sama, kirimkan error
            return back()->withErrors("Matakuliah sedang dijadwalkan.");
        } else {
            $matakuliah->delete();
            return redirect('/matakuliah-D4')->with('success','Matakuliah berhasil dihapus!');
        }
    }

    //Hasil
    //Kartu Ujian
    public function kartu_ujian(){
        $user = Auth::User();
        $prodi = Prodi::select('id_prodi','prodi')->get();
        $kelas = Mahasiswa::select('kelas')->distinct('kelas')->get();
        $mahasiswa = Mahasiswa::all();
        $ketua = Ketua::where('id_ketua','1')->get();
        return view("pages.admin.hasil.kartuujian.kartu_ujian", ['type_menu' => ''], compact('user','prodi','mahasiswa','ketua','kelas'));
    }

    public function cetak_mhs()
    {
        $user = Auth::User();
        return view("pages.admin.hasil.kartuujian.cetak", ['type_menu' => ''], compact('user'));
    }

    //Pengaturan
    public function pengaturan()
    {
        $user = Auth::user();
        if (Auth::user()) {
            if ($user->level == "admin")
            {
                return view("pages.pengaturan.admin.profil", ['type_menu' => ''], compact('user'));
            }
            elseif ($user->level == "petugas")
            {
                return view("pages.pengaturan.petugas.profil", ['type_menu' => ''], compact('user'));
            }
            elseif ($user->level == "keuangan")
            {
                return view("pages.pengaturan.keuangan.profil", ['type_menu' => ''], compact('user'));
            }
            else
            {
                return view("pages.pengaturan.pengawas.profil", ['type_menu' => ''], compact('user'));
            }
        }
    }

    public function update_profil($id, Request $request)
    {
        $profil = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama'       => 'required',
            'email'       => 'required|unique:users,email,'.$profil->id_users.',id_users',
        ],
        [
            'nama.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.unique' => 'Email sudah ada, coba yang lain.',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $profil->detail->nama = $request->nama;
        $profil->email = $request->email;
        $profil->push();
        return redirect('/pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

     public function update_password(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'password_lama' => [
                'required',
                function ($attribute, $value, $fail) use ($users) {
                    if (!Hash::check($value, $users->password)) {
                        $fail('Password lama tidak sesuai.');
                    }
                },
            ],
            'password_baru' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'password_konfirmasi' => 'required|same:password_baru',
        ],
        [
            'password_lama.required' => 'Password lama tidak boleh kosong.',
            'password_lama.same' => 'Password lama tidak sesuai.',
            'password_baru.required' => 'Password baru tidak boleh kosong.',
            'password_baru.min' => 'Password baru harus berisi minimal 8 karakter.',
            'password_baru.regex' => 'Kombinasikan password Anda.',
            'password_konfirmasi.required' => 'Password konfirmasi tidak boleh kosong.',
            'password_konfirmasi.same' => 'Password baru dan konfirmasi password harus sama.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $users->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return redirect('pengaturan')->with('success', 'Password berhasil diperbarui');
    }

    public function notFound()
    {
        return route("not.found");
    }
}
