<section>
    <header>
        <h2 class="text-lg font-medium text-black">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-black">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="!text-black" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full !text-black" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 !text-black" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="!text-black" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full !text-black" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 !text-black" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="!text-black" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full !text-black" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 !text-black" />
        </div>

         <div class="flex flex-col before:gap-4 md:flex-row">
            <x-save-button class="md:w-auto md:h-10 text-xl">{{ __('Save') }}</x-save-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-black"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
