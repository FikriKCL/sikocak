<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
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
            'username' => ['required', 'string', 'lowercase', 'alpha-dash', 'unique:users,username'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $user = DB::table('users')
                        ->select('id', 'email_verified_at')
                        ->where('email', $value)
                        ->first();

                    if ($user) {
                        if ($user->email_verified_at) {
                            $fail('Email sudah terdaftar dan diverifikasi.');
                        } else {
                            $fail('Email sudah terdaftar tapi belum diverifikasi.');
                        }
                    }
                },
            ],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
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
