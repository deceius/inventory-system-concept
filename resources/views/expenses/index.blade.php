<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Expenses') }}">
            <x-slot:icon>
                <x-icons.form/>
            </x-slot>
            <x-slot:buttons>
                <x-ui.button.link href="{{ route('items.create') }}" style="success" text="{{ __('New Expense') }}">
                    <x-slot:icon>
                        <x-icons.button.create/>
                    </x-slot>
                </x-ui.button.link>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div x-data="itemsIndex" x-init="loadEverything()">
        <x-ui.toolbar>
            <div class="space-x-3 flex items-center h-5">
                <x-ui.search click-method="loadEverything()" model="filter.search" />
            </div>
        </x-ui.toolbar>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <x-ui.card.table>
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
                                                <td class="border-b py-3 px-5" x-text='item.type.name'></td>
                                                <td class="border-b py-3 px-5" x-text='item.type.name'></td>
                                                <td class="border-b py-3 px-5" x-text='getItemFullName(item)'></td>
                                                <td class="border-b py-3 px-5 text-gray-400 italic" x-text='item.last'></td>
                                                <td class=" whitespace-nowrap border-b py-3 px-5 text-end">
                                                    <td class=" whitespace-nowrap border-b py-3 px-5 text-end">
                                                        <form method="get" :action="item.url + '/edit'"  x-show="item.is_active">
                                                            <x-ui.button.button-icon type="submit" style="secondary">
                                                                <x-icons.button.edit/>
                                                            </x-ui.button>
                                                        </form>
                                                        <form method="post" :action="item.url + '/activate'"  x-show="!item.is_active">
                                                            @csrf
                                                            @method('PATCH')
                                                            <x-ui.button.button-icon type="submit" style="success" text="{{ __('Activate') }}">
                                                                <x-icons.button.check/>
                                                            </x-ui.button>
                                                        </form>
                                                    </td>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                        </div>
                        <div class="p-6 flex justify-end">
                            <x-ui.pagination links="result.links"/>
                        </div>
                    </x-slot>
                </x-ui.card>
            </div>
        </div>
    </div>

</x-app-layout>
