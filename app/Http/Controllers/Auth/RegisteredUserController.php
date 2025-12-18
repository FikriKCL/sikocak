<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255', 
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->select('id', 'email_verified_at')->first();
                    
                    if ($user) {
                        if ($user->hasVerifiedEmail()) {
                            $fail('Email sudah terdaftar dan diverifikasi. Silakan login.');
                        } else {
                            $fail('Email sudah terdaftar tetapi belum diverifikasi. Silakan cek inbox Anda atau kirim ulang link verifikasi.');
                        }
                    }
                },
            ],
            'username' => ['required', 'string', 'lowercase', 'alpha-dash', 'unique:users,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'id_rank' => 1
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('verification.notice', absolute: false));
}
}
