<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */

        public function update(Request $request)
        {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            // 1. Cari user berdasarkan email
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'Email tidak terdaftar',
                ]);
            }

            // 2. Cek apakah password baru sama dengan password lama
            if (Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Password baru tidak boleh sama dengan password sebelumnya',
                ]);
            }

            // 3. Update password
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('status', 'Password berhasil diperbarui');
        }

}
