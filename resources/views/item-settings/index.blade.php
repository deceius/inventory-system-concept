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
                        <div class="p-6 flex justify-end" x-show="result.last_page > 1">

                            <x-ui.pagination links="result.links"></x-ui.pagination>
                          </div>
                    </x-slot>
                </x-ui.card>
            </div>
        </div>
    </div>

</x-app-layout>
