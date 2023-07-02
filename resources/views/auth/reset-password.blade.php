<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-ui.input.label for="email" :value="__('Email')" />
            <x-ui.input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-ui.input.error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui.input.label for="password" :value="__('Password')" />
            <x-ui.input.text id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-ui.input.error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui.input.label for="password_confirmation" :value="__('Confirm Password')" />

            <x-ui.input.text id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-ui.input.error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-ui.button type="submit" text="{{ __('Reset Password') }}">

            </x-ui.button>
        </div>
    </form>
</x-guest-layout>
