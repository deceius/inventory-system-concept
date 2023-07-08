<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Edit User') }}">
            <x-slot:icon>
                <x-icons.user/>
            </x-slot>
            <x-slot:buttons>
                @if (!$user->trashed())
                    <x-custom.button.deactivate action="{{ $user->url . '/deactivate' }}" method="post" text="{{ __('Deactivate') }}"/>
                @else
                    <x-custom.button.activate action="{{ $user->url . '/activate' }}" method="post" text="{{ __('Activate') }}"/>
                @endif
            </x-slot>
            <x-slot:prev-level>
                <a class="text-indigo-400 font-light underline" href="{{ route('admin.users.index') }}">{{ __('User Management') }}</a>
                <x-icons.breadcrumb/>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot:title>{{ __('User Information') }}</x-slot>
                <x-slot:icon>
                    <x-icons.user-circle/>
                </x-slot>
                <x-slot:content>
                    <form method="POST" action="{{ $user->url . '/update' }}">
                        @csrf
                        @method('PATCH')
                        <!-- Name -->
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Name')" />
                            <x-ui.form.input.text id="name" :disabled="!$user->is_active" :value="old('name', $user->name)" class="block mt-1 w-full" type="text" name="name"  required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-ui.form.input.label for="email" :value="__('Email')" />
                            <x-ui.form.input.text id="email" :disabled="true" :value="old('email', $user->email)" class="block mt-1 w-full" type="email" name="email" required  />
                            <x-ui.form.input.error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-ui.form.input.label for="branch_id" :value="__('Branch')" />
                            <x-ui.form.select id="branch_id"
                                        class="block mt-1 w-full"
                                        name="branch_id"
                                        :disabled="!$user->is_active"
                                        :value="old('branch_id', $user->branch_id)">
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}" {{ $branch->id == old('branch_id', $user->branch_id) ? 'selected' : ''}}>{{ $branch->name }}</option>
                                @endforeach
                            </x-ui.form.select>
                            <x-ui.form.input.error :messages="$errors->get('branch_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-ui.form.input.label for="access_tier" :value="__('Access Level')" />
                            <x-ui.form.select id="access_tier"
                                        class="block mt-1 w-full"
                                        name="access_tier"
                                        :value="old('access_tier', $user->access_tier)"
                                         :disabled="!$user->is_active"
                                        required>
                                @foreach ($tiers as $key => $value)
                                    <option value="{{$key + 1}}" {{ $key + 1 == old('access_tier', $user->access_tier) ? 'selected' : ''}}>{{ __($value) }}</option>
                                @endforeach
                            </x-ui.form.select>
                            <x-ui.form.input.error :messages="$errors->get('access_tier')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            <x-ui.button type="submit" text="{{ __('Update User') }}" :disabled="!$user->is_active">
                            </x-ui.button>
                            @if (session('status') === 'user-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Updated.') }}</p>
                            @endif
                        </div>
                    </form>
                </x-slot>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>
