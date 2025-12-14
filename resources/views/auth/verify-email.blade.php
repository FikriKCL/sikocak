<x-register-layout>
          {{-- <-- INI COMMENT --> --}}
    <div class="flex flex-col gap-4">
        <div class="text-sm text-black text-center">
            {{ __('Terima Kasih telah mendaftar! Tolong Verifikasi Emailmu, Jika tidak ada email silahkan tekan tombol kembali!.') }}
        </div>

        <form method="POST" action="{{ route('verification.send') }}" class="flex justify-center">
            @csrf
            <x-login-button class="mt-2 text-xs bg-[#9DFF00] px-4 py-1 font-semibold tracking-tighter rounded-2xl">
                {{ __('Kirim Ulang') }}
            </x-login-button>
        </form>
            
        <form method="POST" action="{{ route('logout') }}" class="mt-6 text-center">
            @csrf
            <p class="text-sm">Salah Email?</p>
            <button class="text-sm underline text-black">
                Kembali ke Menu Sebelumnya
            </button>
            <p class="text-sm">Jika sudah terverifikasi silahkan tutup jendela ini.</p>
        </form>


        @if (session('status') == 'verification-link-sent')
            <div class="font-medium text-sm text-green-600 text-center">
                {{ __('Link Verifikasi yang baru telah dikirim. Cek kembali!.') }}
            </div>
        @endif
    </div>
</x-register-layout>
