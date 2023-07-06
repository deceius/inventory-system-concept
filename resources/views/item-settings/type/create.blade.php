<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Create Type') }}">
            <x-slot:icon>
                <x-icons.master-data/>
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
                <x-slot:title>{{ __('Type Information') }}</x-slot>
                <x-slot:icon>
                    <x-icons.form/>
                </x-slot>
                <x-slot:content>
                    <form method="POST" action="{{ route('items.settings.types.store') }}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Name')" />
                            <x-ui.form.input.text id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
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
