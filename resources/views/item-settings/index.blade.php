<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Item Settings') }}">
            <x-slot:icon>
                <x-icons.master-data/>
            </x-slot>
            <x-slot:prev-level>
                <span>{{ __('Master Data') }}</span>
                <x-icons.breadcrumb></x-icons.breadcrumb>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <x-ui.card.table x-data="typesIndex" x-init="loadEverything()">
                    <x-slot:title>
                        {{ __('Types') }}
                    </x-slot>
                    <x-slot:icon>
                        <x-icons.master-table/>
                    </x-slot>
                    <x-slot:buttons>
                        <x-ui.search model="filter.search" click-method="loadTypes()"/>
                        <x-ui.button.link href="{{ route('items.settings.types.create') }}" style="success" text="{{ __('Create Type') }}">
                            <x-slot:icon>
                                <x-icons.button.create/>
                            </x-slot>
                        </x-ui.button.link>
                    </x-slot>
                    <x-slot:content ::class="{ 'opacity-50' : isLoading }">
                        <div class="overflow-x-auto">
                            <table id="table" class="min-w-full">
                                    <thead class="font-medium">
                                        <tr class="border-b-2 border-gray-300">
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Name') }}
                                            </th>
                                            <th scope="col" class="text-start py-3 px-5">
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="item in result.data">
                                            <tr class="border-gray-300 text-start" :class="{ 'opacity-50' : !item.is_active }">
                                                <td class="border-b py-3 px-5" x-text='item.name'></td>
                                                <td class=" whitespace-nowrap border-b py-3 px-5 text-end">
                                                    <x-ui.button.link style="secondary" ::href="item.url + '/edit'">
                                                        <x-slot:icon>
                                                            <x-icons.button.edit/>
                                                        </x-slot>
                                                    </x-ui.button.link>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                        </div>
                        <div class="p-6 flex justify-end" x-show="result.last_page > 1">
                            <x-ui.pagination links="result.links"></x-ui.pagination>
                          </div>
                    </x-slot>
                </x-ui.card>
                <x-ui.card.table x-data="brandsIndex" x-init="loadEverything()">
                    <x-slot:title>
                        {{ __('Brands') }}
                    </x-slot>
                    <x-slot:icon>
                        <x-icons.master-table/>
                    </x-slot>
                    <x-slot:buttons>
                        <x-ui.search model="filter.search" click-method="loadBrands()"/>
                        <x-ui.button.link href="{{ route('items.settings.brands.create') }}" style="success" text="{{ __('Create Brand') }}">
                            <x-slot:icon>
                                <x-icons.button.create/>
                            </x-slot>
                        </x-ui.button.link>
                    </x-slot>
                    <x-slot:content ::class="{ 'opacity-50' : isLoading }">
                        <div class="overflow-x-auto">
                            <table id="table" class="min-w-full">
                                    <thead class="font-medium">
                                        <tr class="border-b-2 border-gray-300">
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Name') }}
                                            </th>

                                            <th scope="col" class="text-start py-3 px-5">
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="item in result.data">
                                            <tr class="border-gray-300 text-start" :class="{ 'opacity-50' : !item.is_active }">
                                                <td class="border-b py-3 px-5" x-text='item.name'></td>
                                                <td class=" whitespace-nowrap border-b py-3 px-5 text-end">
                                                    <x-ui.button.link style="secondary" ::href="item.url + '/edit'">
                                                        <x-slot:icon>
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-ui.button.link>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                        </div>
                        <div class="p-6 flex justify-end" x-show="result.last_page > 1">

                            <x-ui.pagination links="result.links"></x-ui.pagination>
                          </div>
                    </x-slot>
                </x-ui.card>
            </div>
        </div>
    </div>

</x-app-layout>
