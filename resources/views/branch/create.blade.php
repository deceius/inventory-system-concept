<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="{{ __('New Branch') }}">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                  </svg>
            </x-slot>
        </x-ui.page-header>
    </x-slot>

    <div class="py-12">
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
                    <form method="post" action="{{ route('admin.branch.store') }}">
                        @csrf
                        <div class="mb-6">
                            <x-ui.input.label for="name" :value="__('Branch Name')" />
                            <x-ui.input.text id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-6">
                            <x-ui.input.label for="tin" :value="__('TIN')" />
                            <x-ui.input.text id="tin" name="tin" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('tin')" />
                        </div>
                        <div class="mb-6">
                            <x-ui.input.label for="address" :value="__('Address')" />
                            <x-ui.input.text id="address" name="address" type="text" class="mt-1 block w-full" required autofocus autocomplete="address" />
                            <x-ui.input.error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-ui.button type="submit" text="{{ __('Save') }}"></x-ui.button>
                        </div>
                    </form>
                </x-slot>
            </x-ui.card>

        </div>
    </div>
</x-app-layout>
