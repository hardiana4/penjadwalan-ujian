<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LupaPasswordController extends Controller
{
    // use SendsPasswordResetEmails;

    public function reset()
    {
        return view("pages.resetpw");
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

         $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

         session(['email' => $request->email]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __('Tautan reset kata sandi telah berhasil dikirim ke alamat email Anda!')])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetProses(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ],
        [
            'password.required' => 'Password baru tidak boleh kosong.',
            'password.min' => 'Password baru harus berisi minimal 8 karakter.',
            'password.confirmed' => 'Password baru dan konfirmasi password harus sama.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('masuk')->with('success', 'Kata sandi berhasil direset. Silakan masuk dengan kata sandi baru Anda.')
            : back()->withErrors(['email' => [__($status)]]);
    }


}
