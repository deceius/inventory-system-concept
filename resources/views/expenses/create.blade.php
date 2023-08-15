<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('New Expense') }}">
            <x-slot:icon>
                <x-icons.form/>
            </x-slot>

            <x-slot:prev-level>
                <a class="text-indigo-400 font-light underline" href="{{ route('expenses.index') }}">{{ __('Expenses') }}</a>
                <x-icons.breadcrumb/>
            </x-slot>
        </x-ui.header>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot:title>{{ __('Expense Information') }}</x-slot>
                <x-slot:icon>
                    <x-icons.form/>
                </x-slot>
                <x-slot:content>
                    <form method="POST" action="{{ route('expenses.store') }}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-ui.form.input.label for="description" :value="__('Description')" />
                            <x-ui.form.input.text id="description" class="block mt-1 w-full" type="text" name="description" required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="date" :value="__('Date')" />
                            <x-ui.form.input.text id="date" class="block mt-1 w-full" type="date" name="date" required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="cost" :value="__('Cost')" />
                            <x-ui.form.input.text id="cost" class="block mt-1 w-full" type="text" name="cost" required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('cost')" class="mt-2" />
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
