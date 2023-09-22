<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class KeuanganController extends Controller
{
    public function verifikasi ()
    {
        $user = Auth::User();
        $mahasiswa = Mahasiswa::all();
        $dt_lunas = Mahasiswa::where('status','1')->count();
        $dt_belum = Mahasiswa::where('status','0')->count();
        $data = array
        (
            'mahasiswa' => $mahasiswa
        );
        return view("pages.keuangan.verifikasi", ['type_menu' => ''], compact('user','mahasiswa','dt_lunas','dt_belum'));

    }

    public function kurang(Request $request)
    {
        $id = $request->idnya;
        $count = count($id);
        $kurang = '0';
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Mahasiswa::find($id[$i]);
            // check enum
            $data->update(['status' => $kurang]);
        }
    }

    public function update_batalkan(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'UKT'          => 'required',
            'SPI'          => 'required',
        ],
        [
            'UKT.required' => 'UKT tidak boleh kosong.',
            'SPI.required' => 'SPI tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $batalkan = '0';

       if ($request->UKT === 'Rp. 0' && $request->SPI === 'Rp. 0') {
            return redirect()->back()->withInput()->withErrors([
                'uktspi' => 'Anda tidak boleh memasukkan UKT dan SPI dengan Rp. 0 untuk mengubah status menjadi BELUM LUNAS'
            ]);
        }

        $mahasiswa->update([
            $mahasiswa->status = $batalkan,
            $mahasiswa->UKT = $request->UKT,
            $mahasiswa->SPI = $request->SPI,
            ]);
        return redirect('/verifikasi')->with('success', 'Status pembayaran mahasiswa berhasil diperbarui.');
    }

    public function update_kurang(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'UKT'          => 'required',
            'SPI'          => 'required',
        ],
        [
            'UKT.required' => 'UKT tidak boleh kosong.',
            'SPI.required' => 'SPI tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswa->update([
            $mahasiswa->UKT = $request->UKT,
            $mahasiswa->SPI = $request->SPI,
            ]);
        return redirect('/verifikasi')->with('success', 'Detail pembayaran mahasiswa berhasil diperbarui.');
    }

    public function lunas(Request $request)
    {
        $id = $request->idnya;
        $count = count($id);
        $lunas = '1';
        $biaya = '';
        // loop data array
        for ($i=0; $i < $count ; $i++) {
            // cari data mahasiswa
            $data = Mahasiswa::find($id[$i]);
            // check enum
            $data->update(['status' => $lunas,
                            'ukt' => $biaya,
                            'SPI' => $biaya]);
        }
    }

}
