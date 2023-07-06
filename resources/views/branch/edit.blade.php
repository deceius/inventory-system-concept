<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Edit Branch') }}">
            <x-slot:icon>
                <x-icons.branch/>
            </x-slot>
            <x-slot:buttons>
                @if (old('isActive', $branch->is_active))
                    <x-custom.button.deactivate action="{{ $branch->url . '/deactivate' }}" text="{{ __('Deactivate') }}"/>
                @else
                    <x-custom.button.activate action="{{ $branch->url . '/activate' }}" text="{{ __('Activate') }}"/>
                @endif
            </x-slot>
            <x-slot:prev-level>
                <a class="text-indigo-400 font-light underline" href="{{ route('admin.branch.index') }}">{{ __('Branch Master Data') }}</a>
                <x-icons.breadcrumb/>
            </x-slot>
        </x-ui.header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot:title>{{ __('Branch Information') }}</x-slot>
                <x-slot:icon>
                    <x-icons.form/>
                </x-slot>
                <x-slot:content>
                    <form method="post" action="{{ $branch->url . '/update' }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Branch Name')" />
                            <x-ui.form.input.text id="name" :disabled="!$branch->is_active"  :value="old('name', $branch->name)" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="tin" :value="__('TIN')" />
                            <x-ui.form.input.text id="tin" :disabled="!$branch->is_active"  name="tin" :value="old('name', $branch->tin)" type="text" class="mt-1 block w-full" required autofocus autocomplete="tin" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('tin')" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="address" :value="__('Address')" />
                            <x-ui.form.input.text id="address" :disabled="!$branch->is_active" name="address" :value="old('name', $branch->address)" type="text" class="mt-1 block w-full" required autofocus autocomplete="address" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            <x-ui.button :disabled="!$branch->is_active"  type="submit" text="{{ __('Update') }}"></x-ui.button>
                            @if (session('status') === 'branch-updated')
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
            @if ($branch->is_active)
                <x-ui.card>
                    <x-slot:title>
                        {{ __('Users') . ' | ' . old('name', $branch->name) }}
                    </x-slot>
                    <x-slot:icon>
                        <x-icons.list/>
                    </x-slot>
                    <x-slot:buttons>
                        <x-ui.button style="secondary" text="{{ __('Assign User') }}">
                            <x-slot:icon>
                                <x-icons.button.switch/>
                            </x-slot>
                        </x-ui.button>
                        <x-ui.button style="success" text="{{ __('New User') }}">
                            <x-slot:icon>
                                <x-icons.button.user-new/>
                            </x-slot>
                        </x-ui.button>
                    </x-slot>
                    <x-slot:content>
                        {{ $branch->is_active }}
                    </x-slot>
                </x-ui.card>
            @endif

        </div>
    </div>
</x-app-layout>
