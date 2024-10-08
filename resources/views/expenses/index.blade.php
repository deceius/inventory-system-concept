<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Expenses') }}">
            <x-slot:icon>
                <x-icons.form/>
            </x-slot>
            <x-slot:buttons>
                <x-ui.button.link href="{{ route('expenses.create') }}" style="secondary" text="{{ __('Export Data') }}">
                    <x-slot:icon>
                        <x-icons.button.doc-text/>
                    </x-slot>
                </x-ui.button.link>
                <x-ui.button.link href="{{ route('expenses.create') }}" style="success" text="{{ __('New Expense') }}">
                    <x-slot:icon>
                        <x-icons.button.create/>
                    </x-slot>
                </x-ui.button.link>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div x-data="expensesIndex" x-init="load()">
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <x-ui.card.table>
                    <x-slot:title>
                        {{ Carbon\Carbon::now()->format('F d, Y')  }} | Branch Expense Summary
                    </x-slot>
                    <x-slot:icon>
                        <x-icons.list/>
                    </x-slot>
                    <x-slot:content>
                        <div class="overflow-x-auto">
                            <table id="table" class="min-w-full">
                                    <tbody>
                                        <tr class="border-b border-gray-300">
                                            <th scope="col" class="text-start py-3 px-5" width="30%">
                                                {{ __('Total Expense Cost') }}
                                            </th>
                                            <td scope="col" class="text-start py-3 px-5">
                                                {{ __('123,456.78') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Expense-Income %') }}
                                            </th>
                                            <td scope="col" class="text-start py-3 px-5">
                                                {{ __('50%') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </x-slot>
                </x-ui.card.table>
                <x-ui.card.table>
                    <x-slot:title>
                        {{ __('Expenses') }}
                    </x-slot>
                    <x-slot:icon>
                        <x-icons.master-table/>
                    </x-slot>
                    <x-slot:buttons>
                        <x-ui.search model="filter.search" click-method="load()"/>

                    </x-slot>
                    <x-slot:content ::class="{ 'opacity-50' : isLoading }">
                        <div class="overflow-x-auto">
                            <table id="table" class="min-w-full">
                                    <thead class="font-medium">
                                        <tr class="border-b-2 border-gray-300">
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Description') }}
                                            </th>
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Date') }}
                                            </th>
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Cost') }}
                                            </th>
                                            <th scope="col" class="text-start py-3 px-5">
                                                &nbsp;
                                            </th>
                                            <th scope="col" class="text-start py-3 px-5">
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="item in result.data">
                                            <tr class="border-gray-300 text-start" :class="{ 'opacity-50' : !item.is_active }">
                                                <td class="border-b py-3 px-5" x-text='item.description'></td>
                                                <td class="border-b py-3 px-5" x-text='item.date'></td>
                                                <td class="border-b py-3 px-5" x-text='item.cost'></td>
                                                <td class="border-b py-3 px-5 text-gray-400 italic" x-text='item.last'></td>
                                                <td class=" whitespace-nowrap border-b py-3 px-5 text-end">
                                                    <td class=" whitespace-nowrap border-b py-3 px-5 text-end">
                                                        <form method="get" :action="item.url + '/edit'"  x-show="item.is_active">
                                                            <x-ui.button.button-icon type="submit" style="secondary">
                                                                <x-icons.button.edit/>
                                                            </x-ui.button>
                                                        </form>
                                                    </td>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                        </div>
                        <div class="p-6 flex justify-between" >
                            <label for="remember_me" class="inline-flex items-center self-end">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" x-model="filter.inactive">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Show Deleted Records') }}</span>
                            </label>
                            <template  x-show="result.last_page > 1">
                                <x-ui.pagination links="result.links"/>
                            </template>
                        </div>
                    </x-slot>
                </x-ui.card>
            </div>
        </div>
    </div>

</x-app-layout>
