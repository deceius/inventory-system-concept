<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-ui.form.input.label for="name" :value="__('Name')" />
            <x-ui.form.input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-ui.form.input.error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-ui.form.input.label for="email" :value="__('Email')" />
            <x-ui.form.input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-ui.form.input.error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-ui.form.input.label for="branch" :value="__('Branch')" />
            <x-ui.form.select id="branch"
                        class="block mt-1 w-full"
                        name="branch"
                        required>
                <option>Emilia (Silang)</option>
                <option>Manager (2)</option>
                <option>Employee (3)</option>
                <option>Readonly (4)</option>
            </x-ui.form.select>
            <x-ui.form.input.error :messages="$errors->get('branch')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-ui.form.input.label for="access_tier" :value="__('Access Level')" />
            <x-ui.form.select id="access_tier"
                        class="block mt-1 w-full"
                        name="access_tier"
                        required>
                <option>Admin</option>
                <option>Manager</option>
                <option>Employee</option>
                <option>Readonly</option>
            </x-ui.form.select>
            <x-ui.form.input.error :messages="$errors->get('access_tier')" class="mt-2" />
        </div>



        <!-- Password -->
        <div class="mt-4">
            <x-ui.form.input.label for="password" :value="__('Password')" />

            <x-ui.form.input.text id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-ui.form.input.error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui.form.input.label for="password_confirmation" :value="__('Confirm Password')" />

            <x-ui.form.input.text id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-ui.form.input.error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-ui.button type="submit" class="ml-4" text="{{ __('Create User') }}">
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>
