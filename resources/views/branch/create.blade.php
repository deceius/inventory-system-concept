<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('New Branch') }}">
            <x-slot:icon>
                <x-icons.branch/>
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
                    <form method="post" action="{{ route('admin.branch.store') }}">
                        @csrf
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Branch Name')" />
                            <x-ui.form.input.text id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="tin" :value="__('TIN')" />
                            <x-ui.form.input.text id="tin" name="tin" type="text" class="mt-1 block w-full" autofocus autocomplete="name" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('tin')" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="address" :value="__('Address')" />
                            <x-ui.form.input.text id="address" name="address" type="text" class="mt-1 block w-full" autofocus autocomplete="address" />
                            <x-ui.form.input.error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            <x-ui.button type="submit" text="{{ __('Save') }}"/>
                        </div>
                    </form>
                </x-slot>
            </x-ui.card>

        </div>
    </div>
</x-app-layout>
