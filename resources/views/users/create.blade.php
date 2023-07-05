<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('New User') }}">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  </svg>
            </x-slot>

            <x-slot:prev-level>
                <a class="text-indigo-400 font-light underline" href="{{ route('admin.users.index') }}">User Management</a>
                <x-icons.breadcrumb/>
            </x-slot>
        </x-ui.header>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot:title>
                    User Information
                </x-slot>
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>

                </x-slot>
                <x-slot:content>
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Name')" />
                            <x-ui.form.input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-ui.form.input.label for="email" :value="__('Email')" />
                            <x-ui.form.input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
                            <x-ui.form.input.error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-ui.form.input.label for="branch_id" :value="__('Branch')" />
                            <x-ui.form.select id="branch_id"
                                        class="block mt-1 w-full"
                                        name="branch_id"
                                        required>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}">{{ $branch->name }}</option>
                                @endforeach
                            </x-ui.form.select>
                            <x-ui.form.input.error :messages="$errors->get('branch_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-ui.form.input.label for="access_tier" :value="__('Access Level')" />
                            <x-ui.form.select id="access_tier"
                                        class="block mt-1 w-full"
                                        name="access_tier"
                                        required>
                                <option value="1">Admin (1)</option>
                                <option value="2">Manager (2)</option>
                                <option value="3">Employee (3)</option>
                                <option value="4">Readonly (4)</option>
                            </x-ui.form.select>
                            <x-ui.form.input.error :messages="$errors->get('access_tier')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-ui.button type="submit" text="{{ __('Create User') }}">
                            </x-ui.button>
                        </div>
                    </form>
                </x-slot>
            </x-ui.card>

        </div>
    </div>
</x-app-layout>
