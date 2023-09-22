<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use App\Imports\UsersDetailsPengawasImport;
use App\Imports\RuanganImport;
use App\Imports\MatakuliahImport;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function downloadTemplateRuangan()
    {
        $path = public_path('template/importRuangan.xlsx');
        $filename = 'importRuangan.xlsx';

        return response()->download($path, $filename);
    }

    public function importRuangan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required'   => 'Pilih file excel terlebih dahulu.',
            'file.mimes'   => 'Jenis file harus xls atau xlsx',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');

        try {
            Excel::import(new RuanganImport(), $file);

            return redirect()->route('ruangan')->with('success', 'Data ruangan berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('ruangan')->with('error', 'Format file tidak sesuai, tolong cek kembali.')->withErrors('Format file tidak sesuai, tolong cek kembali.');
        }
    }

    public function downloadTemplatePgw()
    {
        $path = public_path('template/importPengawas.xlsx');
        $filename = 'importPengawas.xlsx';

        return response()->download($path, $filename);
    }

    public function importPgw(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required'   => 'Pilih file excel terlebih dahulu.',
            'file.mimes'   => 'Jenis file harus xls atau xlsx',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');

        try {
            Excel::import(new UsersDetailsPengawasImport(), $file);

            return redirect()->route('pengawas')->with('success', 'Data pengawas berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('pengawas')->with('error', 'Format file tidak sesuai, tolong cek kembali.')->withErrors('Format file tidak sesuai, tolong cek kembali.');
        }
    }

    public function downloadTemplateMhs()
    {
        $path = public_path('template/importMahasiswa.xlsx');
        $filename = 'importMahasiswa.xlsx';

        return response()->download($path, $filename);
    }

    public function importMhsD3(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required'   => 'Pilih file excel terlebih dahulu.',
            'file.mimes'   => 'Jenis file harus xls atau xlsx',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');

        try {
            Excel::import(new MahasiswaImport(), $file);
            return redirect()->route('mahasiswa.D3')->with('success', 'Data mahasiswa berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('mahasiswa.D3')->with('error', 'Format file tidak sesuai, tolong cek kembali.')->withErrors('Format file tidak sesuai, tolong cek kembali.');
        }
    }

    public function importMhsD4(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required'   => 'Pilih file excel terlebih dahulu.',
            'file.mimes'   => 'Jenis file harus xls atau xlsx',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');

        try {
            Excel::import(new MahasiswaImport(), $file);

            return redirect()->route('mahasiswa.D4')->with('success', 'Data mahasiswa berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('mahasiswa.D4')->with('error', 'Format file tidak sesuai, tolong cek kembali.')->withErrors('Format file tidak sesuai, tolong cek kembali.');
        }
    }

    public function downloadTemplateMatakuliah()
    {
        $path = public_path('template/importMatakuliah.xlsx');
        $filename = 'importMatakuliah.xlsx';

        return response()->download($path, $filename);
    }

    public function importMtkD3(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required'   => 'Pilih file excel terlebih dahulu.',
            'file.mimes'   => 'Jenis file harus xls atau xlsx',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');

        try {
            Excel::import(new MatakuliahImport(), $file);

            return redirect()->route('matakuliah.D3')->with('success', 'Data mata kuliah berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('matakuliah.D3')->with('error', 'Format file tidak sesuai, tolong cek kembali.')->withErrors('Format file tidak sesuai, tolong cek kembali.');
        }
    }

    public function importMtkD4(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required'   => 'Pilih file excel terlebih dahulu.',
            'file.mimes'   => 'Jenis file harus xls atau xlsx',
        ]);

        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');

        try {
            Excel::import(new MatakuliahImport(), $file);

            return redirect()->route('matakuliah.D4')->with('success', 'Data mata kuliah berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('matakuliah.D4')->with('error', 'Format file tidak sesuai, tolong cek kembali.')->withErrors('Format file tidak sesuai, tolong cek kembali.');
        }
    }
}
