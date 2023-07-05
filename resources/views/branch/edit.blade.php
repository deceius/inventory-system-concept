<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="{{ __('Edit Branch') }}">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                  </svg>
            </x-slot>
            <x-slot:buttons>
                @if (old('isActive', $branch->is_active))
                    <form method="post" action="{{ $branch->url . '/deactivate' }}">
                        @csrf
                        @method('PATCH')
                        <x-ui.button type="submit" style="danger" text="{{ __('Deactivate') }}">
                    </x-ui.button>
                @else
                    <form method="post" action="{{ $branch->url . '/activate' }}">
                        @csrf
                        @method('PATCH')
                        <x-ui.button type="submit" style="success" text="{{ __('Activate') }}"></x-ui.button>
                    </form>
                @endif
            </x-slot:buttons>
            <x-slot name="prevLevel">
                <a class="text-indigo-400 font-light underline" href="{{ route('admin.branch.index') }}">Branch Master Data</a>
                <x-icons.breadcrumb></x-icons.breadcrumb>
            </x-slot>
        </x-ui.page-header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot name="title">
                    Branch Information
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                      </svg>
                </x-slot>
                <x-slot name="content">
                    <form method="post" action="{{ $branch->url . '/update' }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-ui.input.label for="name" :value="__('Branch Name')" />
                            <x-ui.input.text id="name" :disabled="!$branch->is_active"  :value="old('name', $branch->name)" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mt-4">
                            <x-ui.input.label for="tin" :value="__('TIN')" />
                            <x-ui.input.text id="tin" :disabled="!$branch->is_active"  name="tin" :value="old('name', $branch->tin)" type="text" class="mt-1 block w-full" required autofocus autocomplete="tin" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('tin')" />
                        </div>
                        <div class="mt-4">
                            <x-ui.input.label for="address" :value="__('Address')" />
                            <x-ui.input.text id="address" :disabled="!$branch->is_active" name="address" :value="old('name', $branch->address)" type="text" class="mt-1 block w-full" required autofocus autocomplete="address" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('address')" />
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
                    <x-slot name="title">
                        {{ __('Users') . ' | ' . old('name', $branch->name) }}
                    </x-slot>
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </x-slot>
                    <x-slot name="buttons">
                        <x-ui.button style="secondary" text="{{ __('Assign User') }}">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M13.2 2.24a.75.75 0 00.04 1.06l2.1 1.95H6.75a.75.75 0 000 1.5h8.59l-2.1 1.95a.75.75 0 101.02 1.1l3.5-3.25a.75.75 0 000-1.1l-3.5-3.25a.75.75 0 00-1.06.04zm-6.4 8a.75.75 0 00-1.06-.04l-3.5 3.25a.75.75 0 000 1.1l3.5 3.25a.75.75 0 101.02-1.1l-2.1-1.95h8.59a.75.75 0 000-1.5H4.66l2.1-1.95a.75.75 0 00.04-1.06z" clip-rule="evenodd" />
                                </svg>
                            </x-slot>
                        </x-ui.button>
                        <x-ui.button style="success" text="{{ __('New User') }}">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 018 18a9.953 9.953 0 01-5.385-1.572zM16.25 5.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                                </svg>
                            </x-slot>
                        </x-ui.button>
                    </x-slot>
                    <x-slot name="content">
                        {{ $branch->is_active }}
                    </x-slot>
                </x-ui.card>
            @endif

        </div>
    </div>
</x-app-layout>
