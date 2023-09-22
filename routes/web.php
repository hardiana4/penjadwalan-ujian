<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LupaPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Landing Page
Route::get('/masuk', [BerandaController::class, 'masuk'])->middleware('guest')->name('masuk');
Route::get('/lupa-kata-sandi', function () {
    return view('pages.lupa');
})->middleware('guest')->name('lupa.password');
Route::get('/atur-ulang-kata-sandi', [LupaPasswordController::class, 'reset'])->middleware('guest')->name('password.reset');
Route::post('/atur-ulang-proses', [LupaPasswordController::class, 'resetProses'])->middleware('guest')->name('reset');
Route::post('/lupa-kata-sandi', [LupaPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

//Cek Dashboard sebelum login
Route::get("/home", [BerandaController::class, "index"])->middleware("auth");
Route::get("/beranda", [BerandaController::class, "index"])->middleware("auth");

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get("/", "index")->middleware('guest')->name("/");
    Route::get("/hasil-pencarian", "hasilPencarian")->middleware('guest')->name("hasil.pencarian");
    Route::post("masuk/proses", "proses");
    Route::get("keluar", "keluar")->name('keluar');
});

//Admin
Route::group(["middleware" => ["auth"]], function () {
    Route::group(["middleware" => ["level:admin"]], function () {
        //Prodi
        Route::get("/prodi",[AdminController::class,"prodi"])->name('prodi');
        Route::get("/tambah-prodi",[AdminController::class,"tambah_prodi"])->name('tambah.prodi');
        Route::post("/tambah-prodi-proses", [AdminController::class,"create_prodi"])->name('create.prodi');
        Route::get("/ubah-prodi/{id}",[AdminController::class,"ubah_prodi"])->name('ubah.prodi');
        Route::post("/update-prodi/{id}", [AdminController::class,"update_prodi"])->name('update.prodi');
        Route::get("/hapus-prodi/{id}", [AdminController::class,"hapus_prodi"])->name('delete.prodi');


        //Pengguna
        //Pengawas
        Route::get("/pengawas",[AdminController::class,"pengawas"])->name('pengawas');
        Route::get("/tambah-pengawas",[AdminController::class,"tambah_pengawas"])->name('tambah.pengawas');
        Route::post("/tambah-pengawas-proses", [AdminController::class,"create_pengawas"])->name('create.pengawas');
        Route::get("/ubah-pengawas/{id}",[AdminController::class,"ubah_pengawas"])->name('ubah.pengawas');
        Route::post("/update-pengawas/{id}", [AdminController::class,"update_pengawas"])->name('update.pengawas');
        Route::get("/hapus-pengawas/{id}", [AdminController::class,"hapus_pengawas"])->name('delete.pengawas');
        Route::post("/checkhapus-pengawas", [AdminController::class,"hps_pengawas"])->name('deleteAll.pengawas');

        //Petugas
        Route::get("/petugas",[AdminController::class,"petugas"]);
        Route::post("/tambah-petugas", [AdminController::class,"create_petugas"])->name('create.petugas');
        Route::get("/ubah-petugas/{id}",[AdminController::class,"ubah_petugas"])->name('ubah.petugas');
        Route::post("/update-petugas/{id}", [AdminController::class,"update_petugas"])->name('update.petugas');
        Route::get("/hapus-petugas/{id}", [AdminController::class,"hapus_petugas"])->name('delete.petugas');

        //Mahasiswa
        //D3
        Route::get("/mahasiswa-D3", [AdminController::class,"mahasiswaD3"])->name('mahasiswa.D3');
        Route::get("/tambah-mahasiswa-D3", [AdminController::class,"tambah_mahasiswaD3"])->name('tambah.mahasiswaD3');
        Route::post("/tambah-mahasiswaD3-proses", [AdminController::class,"create_mahasiswaD3"])->name('create.mahasiswaD3');
        Route::get("/ubah-mahasiswaD3/{id}",[AdminController::class,"ubah_mahasiswaD3"])->name('ubah.mahasiswaD3');
        Route::post("/update-mahasiswaD3/{id}", [AdminController::class,"update_mahasiswaD3"])->name('update.mahasiswaD3');
        Route::get("/hapus-mahasiswaD3/{id}", [AdminController::class,"hapus_mahasiswaD3"])->name('delete.mahasiswaD3');
        Route::get("/dosen/{id}", [AdminController::class,"dosen"])->name('dosen');
        Route::post("/naiksemester-mahasiswa-D3", [AdminController::class,"naik_semesterd3"]);
        Route::post("/checkhapus-mahasiswa-D3", [AdminController::class,"hps_semesterd3"])->name('deleteAll.mahasiswaD3');

        Route::get("/unduh-template-pengawas", [ImportController::class,"downloadTemplatePgw"])->name('download.templatePgw');
        Route::post('/import-pengawas', [ImportController::class, 'importPgw'])->name('import.pengawas');
        Route::get("/unduh-template-mahasiswa", [ImportController::class,"downloadTemplateMhs"])->name('download.templateMhs');
        Route::post('/import-mahasiswa-D3', [ImportController::class, 'importMhsD3'])->name('import.mahasiswaD3');
        Route::post('/import-mahasiswa-D4', [ImportController::class, 'importMhsD4'])->name('import.mahasiswaD4');
        Route::get("/unduh-template-ruangan", [ImportController::class,"downloadTemplateRuangan"])->name('download.templateRuangan');
        Route::post('/import-ruangan', [ImportController::class, 'importRuangan'])->name('import.ruangan');
        Route::get("/unduh-template-matakuliah", [ImportController::class,"downloadTemplateMatakuliah"])->name('download.templateMatakuliah');
        Route::post('/import-matakuliah-D3', [ImportController::class, 'importMtkD3'])->name('import.matakuliahD3');
        Route::post('/import-matakuliah-D4', [ImportController::class, 'importMtkD4'])->name('import.matakuliahD4');

        //D4
        Route::get("/mahasiswa-D4", [AdminController::class,"mahasiswaD4"])->name('mahasiswa.D4');
        Route::get("/tambah-mahasiswa-D4", [AdminController::class,"tambah_mahasiswaD4"])->name('tambah.mahasiswaD4');
        Route::post("/tambah-mahasiswaD4-proses", [AdminController::class,"create_mahasiswaD4"])->name('create.mahasiswaD4');
        Route::get("/ubah-mahasiswaD4/{id}",[AdminController::class,"ubah_mahasiswaD4"])->name('ubah.mahasiswaD4');
        Route::post("/update-mahasiswaD4/{id}", [AdminController::class,"update_mahasiswaD4"])->name('update.mahasiswaD4');
        Route::get("/hapus-mahasiswaD4/{id}", [AdminController::class,"hapus_mahasiswaD4"])->name('delete.mahasiswaD4');
        Route::post("/naiksemester-mahasiswa-D4", [AdminController::class,"naik_semesterd4"]);
        Route::post("/checkhapus-mahasiswa-D4", [AdminController::class,"hps_semesterd4"])->name('deleteAll.mahasiswaD3');

        //Mata Kuliah
        //D3
        Route::get("/matakuliah-D3", [AdminController::class,"matakuliahD3"])->name('matakuliah.D3');
        Route::get("/tambah-matakuliah-D3", [AdminController::class,"tambah_matakuliahD3"])->name('tambah.matakuliahD3');
        Route::post("/tambah-matakuliahD3-proses", [AdminController::class,"create_matakuliahD3"])->name('create.matakuliahD3');
        Route::get("/ubah-matakuliahD3/{id}",[AdminController::class,"ubah_matakuliahD3"])->name('ubah.matakuliahD3');
        Route::post("/update-matakuliahD3/{id}", [AdminController::class,"update_matakuliahD3"])->name('update.matakuliahD3');
        Route::get("/hapus-matakuliahD3/{id}", [AdminController::class,"hapus_matakuliahD3"])->name('delete.matakuliahD3');
        Route::post("/checkhapus-matakuliah", [AdminController::class,"hps_matakuliah"])->name('deleteAll.matakuliah');

        //D4
        Route::get("/matakuliah-D4", [AdminController::class,"matakuliahD4"])->name('matakuliah.D4');
        Route::get("/tambah-matakuliah-D4", [AdminController::class,"tambah_matakuliahD4"])->name('tambah.matakuliahD4');
        Route::post("/tambah-matakuliahD4-proses", [AdminController::class,"create_matakuliahD4"])->name('create.matakuliahD4');
        Route::get("/ubah-matakuliahD4/{id}",[AdminController::class,"ubah_matakuliahD4"])->name('ubah.matakuliahD4');
        Route::post("/update-matakuliahD4/{id}", [AdminController::class,"update_matakuliahD4"])->name('update.matakuliahD4');
        Route::get("/hapus-matakuliahD4/{id}", [AdminController::class,"hapus_matakuliahD4"])->name('delete.matakuliahD4');

        //Ketua Panitia
        Route::get("/ketua-panitia", [AdminController::class,"ketua_panitia"])->name('ketua');
        Route::post("/update-ketua/{id}", [AdminController::class,"update_ketua"])->name('update.ketua');
        Route::post("/update-ttd/{id}", [AdminController::class,"update_ttd"])->name('update.ttd');

        //Sesi
        Route::get("/sesi",[AdminController::class,"sesi"])->name('sesi');
        Route::get("/tambah-sesi", [AdminController::class,"tambah_sesi"])->name('tambah.sesi');
        Route::post("/tambah-sesi-proses", [AdminController::class,"create_sesi"])->name('create.sesi');
        Route::get("/ubah-sesi/{id}", [AdminController::class,"ubah_sesi"])->name('ubah.sesi');
        Route::post("/update-sesi-proses/{id}", [AdminController::class,"update_sesi"])->name('update.sesi');
        Route::get("/hapus-sesi/{id}", [AdminController::class,"hapus_sesi"])->name('delete.sesi');

        //Gedung
        Route::get("/gedung",[AdminController::class,"gedung"])->name('gedung');
        Route::get("/tambah-gedung", [AdminController::class,"tambah_gedung"])->name('tambah.gedung');
        Route::post("/tambah-gedung-proses", [AdminController::class,"create_gedung"])->name('create.gedung');
        Route::get("/ubah-gedung/{id}", [AdminController::class,"ubah_gedung"])->name('ubah.gedung');
        Route::post("/update-gedung-proses/{id}", [AdminController::class,"update_gedung"])->name('update.gedung');
        Route::get("/hapus-gedung/{id}", [AdminController::class,"hapus_gedung"])->name('delete.gedung');

        //Ruangan
        Route::get("/ruangan",[AdminController::class,"ruangan"])->name('ruangan');
        Route::get("/tambah-ruangan", [AdminController::class,"tambah_ruangan"])->name('tambah.ruangan');
        Route::post("/tambah-ruangan-proses", [AdminController::class,"create_ruangan"])->name('create.ruangan');
        Route::get("/ubah-ruangan/{id}", [AdminController::class,"ubah_ruangan"])->name('ubah.ruangan');
        Route::post("/update-ruangan-proses/{id}", [AdminController::class,"update_ruangan"])->name('update.ruangan');
        Route::post("/checkhapus-ruangan", [AdminController::class,"hps_ruangan"])->name('deleteAll.ruangan');

        //Kartu Ujian
        Route::get("/kartu-ujian",[AdminController::class,"kartu_ujian"])->name('ku');
        Route::get("/mahasiswa/{id}", [AdminController::class,"mahasiswa"])->name('mahasiswa');
        Route::get("/cetak",[AdminController::class,"cetak"])->name('cetak');
        Route::get("/cetak-prodi",[CetakController::class,"cetakProdi"])->name('print.prodi');
        Route::get('/cetak-mahasiswa', [CetakController::class, 'cetakMhs'])->name('print.mhs');
        Route::get('/cetak-kelas', [CetakController::class, 'cetakKelas'])->name('print.kelas');

        //Pengaturan
        Route::get("/pengaturan",[AdminController::class,"pengaturan"])->name('pengaturan');

    });
});


//Petugas
Route::group(["middleware" => ["auth"]], function () {
    Route::group(["middleware" => ["level:petugas"]], function () {
    //Tr_Matakuliah
    Route::get("/tahun-pelajaran", [PetugasController::class,"tahun_pelajaran"])->name('tahun.pelajaran');
    Route::post("/update-tahun-pelajaran/{id}", [PetugasController::class,"update_tapel"])->name('update.tapel');
    Route::post("/checkhapus-trmatkul", [PetugasController::class,"hps_matkul"])->name('deleteAll.trmatakuliah');
    Route::get('/get-matkul', [AjaxController::class, 'getMatkul']);

    //D3
    Route::get("/penjadwalan-matakuliah-D3", [PetugasController::class,"tr_matakuliahD3"])->name('trmatakuliahD3');
    Route::get("/tambah-penjadwalan-matakuliah-D3", [PetugasController::class,"tambah_trmatakuliahD3"])->name('tambah.trmatakuliahD3');
    Route::post("/tambah-penjadwalan-matakuliah-D3/proses", [PetugasController::class,"create_trmatakuliahD3"])->name('create.trmatakuliahD3');
    Route::get("/ubah-penjadwalan-matakuliah-D3/{id}",[PetugasController::class,"ubah_trmatakuliahD3"])->name('ubah.trmatakuliahD3');
    Route::post("/update-penjadwalan-matakuliah-D3/{id}", [PetugasController::class,"update_trmatakuliahD3"])->name('update.trmatakuliahD3');
    Route::get("/hapus-penjadwalan-matakuliah-D3/{id}", [PetugasController::class,"hapus_trmatakuliahD3"])->name('delete.trmatakuliahD3');
    //D4
    Route::get("/penjadwalan-matakuliah-D4", [PetugasController::class,"tr_matakuliahD4"])->name('trmatakuliahD4');
    Route::get("/tambah-penjadwalan-matakuliah-D4", [PetugasController::class,"tambah_trmatakuliahD4"])->name('tambah.trmatakuliahD4');
    Route::post("/tambah-penjadwalan-matakuliah-D4/proses", [PetugasController::class,"create_trmatakuliahD4"])->name('create.trmatakuliahD4');
    Route::get("/ubah-penjadwalan-matakuliah-D4/{id}",[PetugasController::class,"ubah_trmatakuliahD4"])->name('ubah.trmatakuliahD4');
    Route::post("/update-penjadwalan-matakuliah-D4/{id}", [PetugasController::class,"update_trmatakuliahD4"])->name('update.trmatakuliahD4');
    Route::get("/hapus-penjadwalan-matakuliah-D4/{id}", [PetugasController::class,"hapus_trmatakuliahD4"])->name('delete.trmatakuliahD4');

    //Tr_Ruangan
    Route::get("/penjadwalan-ruangan", [PetugasController::class,"tr_ruangan"])->name('trruangan');
    Route::get("/tambah-penjadwalan-ruangan", [PetugasController::class,"tambah_trruangan"])->name('tambah.trruangan');
    Route::post("/tambah-penjadwalan-ruangan/proses", [PetugasController::class,"create_trruangan"])->name('create.trruangan');
    Route::get('/get-kelas', [AjaxController::class,"getKelas"]);
    Route::get('/get-tr-ruangan-kelas', [AjaxController::class,"getTrRuanganKelas"]);
    Route::get('/get-ruangan', [AjaxController::class,"getRuangan"]);
    Route::get("/hapus-penjadwalan-ruangan/{id}", [PetugasController::class,"hapus_trruangan"])->name('delete.trruangan');
    Route::post("/checkhapus-trruangan", [PetugasController::class,"hps_trruangan"])->name('hapus.trruangan');
    Route::post("/generate-jadwal-ruangan", [GenerateController::class,"generateRuangan"])->name('generate.trruangan');

    //Tr_Jadwal
    //UTS
    Route::get("/penjadwalan-ujian-tengah-semester", [PetugasController::class,"tr_UTS"])->name('trUTS');
    Route::get("/tambah-penjadwalan-ujian-tengah-semester", [PetugasController::class,"tambah_tr_UTS"])->name('tambah.trUTS');
    Route::post("/tambah-penjadwalan-ujian-tengah-semester/proses", [PetugasController::class,"create_tr_UTS"])->name('create.trUTS');
    Route::get('/get-kelas-ujian', [AjaxController::class,"getKelasUjian"]);
    Route::get('/get-ruangan-ujian', [AjaxController::class,"getRuanganUjian"]);
    Route::get('/get-tanggal-ujian', [AjaxController::class,"getTglUjian"]);
    Route::get('/get-sesi-ujian', [AjaxController::class,"getSesiUjian"]);
    Route::get('/get-matakuliah-ujian', [AjaxController::class,"getMatakuliahUjian"]);
    Route::get('/get-trmatakuliah-ujian', [AjaxController::class,"getMatkulTrJadwal"]);
    Route::get('/get-pengawas1-ujian', [AjaxController::class,"getPengawas1Ujian"]);
    Route::get('/get-pengawas2-ujian', [AjaxController::class,"getPengawas2Ujian"]);
    Route::post("/checkhapus-uts", [PetugasController::class,"hps_uts"])->name('hapus.uts');
    Route::post("/generate-jadwal-UTS", [GenerateController::class,"generateUTS"])->name('generate.uts');

    //UAS
    Route::get("/penjadwalan-ujian-akhir-semester", [PetugasController::class,"tr_UAS"])->name('trUAS');
    Route::get("/tambah-penjadwalan-ujian-akhir-semester", [PetugasController::class,"tambah_tr_UAS"])->name('tambah.trUAS');
    Route::post("/tambah-penjadwalan-ujian-akhir-semester/proses", [PetugasController::class,"create_tr_UAS"])->name('create.trUAS');
    Route::post("/checkhapus-uas", [PetugasController::class,"hps_uas"])->name('hapus.uas');
    Route::post("/generate-jadwal-UAS", [GenerateController::class,"generateUAS"])->name('generate.uas');

    //Selesai
    Route::get("/rekap-pengawas", [PetugasController::class,"total"])->name('rekap.pengawas');
    Route::post("/checkhapus-jadwal", [PetugasController::class,"hps_jadwal"])->name('hapus.jadwal');

    //Cetak
    Route::get("/cetak-petugas", [CetakController::class,"cetak"])->name('cetak.petugas');
    Route::get("/cetak-semester-genap", [PetugasController::class,"cetak_genap"])->name('cetak.genap');
    Route::get('/cetak-berkas', [CetakController::class, 'cetakBerkas'])->name('print.berkas');
    Route::get('/cetak-jadwal-prodi', [CetakController::class, 'cetakJadwal'])->name('print.jadwal');
});
    });

//Pengawas
Route::group(["middleware" => ["auth"]], function () {
    Route::group(["middleware" => ["level:pengawas"]], function () {
        Route::get("/jadwal",[PengawasController::class,"jadwal"])->name('jadwal');
        Route::get("/cari-pengganti",[PengawasController::class,"cariPengganti"])->name('cari.pengganti');
        Route::get("/konfirmasi/{id}", [PengawasController::class,"konfirmasi"])->name('konfirmasi');
        });
    });

//Keuangan
Route::group(["middleware" => ["auth"]], function () {
    Route::group(["middleware" => ["level:keuangan"]], function () {
        Route::get("/verifikasi",[KeuanganController::class,"verifikasi"])->name('verifikasi');
        Route::post("/kurang-bayar", [KeuanganController::class,"kurang"]);
        Route::post("/update-pembatalan-lunas/{id}", [KeuanganController::class,"update_batalkan"])->name('update.batalkan');
        Route::post("/update-detail-belum-lunas/{id}", [KeuanganController::class,"update_kurang"])->name('update.kurang');
        Route::post("/lunas", [KeuanganController::class,"lunas"]);
        });
    });

//Pengaturan
Route::get("/pengaturan",[AdminController::class,"pengaturan"])->name('pengaturan');
Route::post("/update-profil/{id}",[AdminController::class,"update_profil"])->name('update.profil');
Route::post("/update-password/{id}",[AdminController::class,"update_password"])->name('update.password');
