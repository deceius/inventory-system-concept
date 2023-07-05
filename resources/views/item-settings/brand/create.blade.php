<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Create Brand') }}">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                  </svg>

            </x-slot>

            <x-slot:prev-level>
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
                <x-slot:content>
                    <form method="POST" action="{{ route('items.settings.brands.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Name')" />
                            <x-ui.form.input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-ui.button type="submit" text="{{ __('Save') }}">
                            </x-ui.button>
                        </div>
                    </form>
                </x-slot>
            </x-ui.card>

        </div>
    </div>
</x-app-layout>
