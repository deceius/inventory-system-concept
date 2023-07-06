<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Edit Brand') }}">
            <x-slot:icon>
                <x-icons.master-data/>
            </x-slot>
            <x-slot:buttons>
                @if (old('isActive', $brand->is_active))
                    <x-custom.button.deactivate action="{{ $brand->url . '/deactivate' }}" method="post" text="{{ __('Deactivate')}}"/>
                @else
                    <x-custom.button.activate action="{{ $brand->url . '/activate' }}" method="post" text="{{ __('Activate')}}"/>
                @endif
            </x-slot>
            <x-slot:prev-level>
                <span>{{ __('Master Data') }}</span>
                <x-icons.breadcrumb/>
                <a class="text-indigo-400 font-light underline" href="{{ route('items.settings.index') }}">{{ __('Item Settings') }}</a>
                <x-icons.breadcrumb/>
            </x-slot>
        </x-ui.header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot:title>{{ __('Brand Information') }}</x-slot>
                <x-slot:icon>
                    <x-icons.form/>
                </x-slot>
                <x-slot:content>
                    <form method="post" action="{{ $brand->url . '/update' }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Name')" />
                            <x-ui.form.input.text id="name" :disabled="!$brand->is_active"  :value="old('name', $brand->name)" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="flex items-center gap-2 mt-4">
                            <x-ui.button :disabled="!$brand->is_active"  type="submit" text="{{ __('Update') }}"></x-ui.button>

                            @if (session('status') === 'updated')
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
