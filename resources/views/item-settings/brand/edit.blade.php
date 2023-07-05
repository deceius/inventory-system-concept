<x-app-layout>
    <x-slot name="header">
        <x-ui.header title="{{ __('Edit Brand') }}">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                  </svg>

            </x-slot>
            <x-slot name="buttons">
                @if (old('isActive', $brand->is_active))
                                <form method="post" action="{{ $brand->url . '/deactivate' }}">
                                    @csrf
                                    @method('PATCH')
                                    <x-ui.button type="submit" style="danger" text="{{ __('Deactivate Data') }}">
                                </x-ui.button>
                            </form>
                            @else
                            <form method="post" action="{{ $brand->url . '/activate' }}">
                                @csrf
                                @method('PATCH')
                                <x-ui.button type="submit" style="success" text="{{ __('Activate Data') }}"></x-ui.button>
                            </form>
                    @endif
            </x-slot>
            <x-slot name="prevLevel">
                <span>Master Data</span>
                <x-icons.breadcrumb></x-icons.breadcrumb>
                <a class="text-indigo-400 font-light underline" href="{{ route('items.settings.index') }}">Item Settings</a>
                <x-icons.breadcrumb></x-icons.breadcrumb>
            </x-slot>
        </x-ui.header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>

                <x-slot name="content">
                    <form method="post" action="{{ $brand->url . '/update' }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-ui.input.label for="name" :value="__('Name')" />
                            <x-ui.input.text id="name" :disabled="!$brand->is_active"  :value="old('name', $brand->name)" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('name')" />
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
