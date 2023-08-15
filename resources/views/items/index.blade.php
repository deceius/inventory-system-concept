<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Items') }}">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                  </svg>
            </x-slot>
            <x-slot:prev-level>
                <span>Master Data</span>
                <x-icons.breadcrumb/>
            </x-slot>
            <x-slot:buttons>
                <x-ui.button.link href="{{ route('items.create') }}" style="success" text="{{ __('Create Item') }}">
                    <x-slot:icon>
                        <x-icons.button.create/>
                    </x-slot>
                </x-ui.button.link>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <x-ui.card.table x-data="itemsIndex" x-init="loadEverything()" >
                    <x-slot:title>
                        {{ __('Items') }}
                    </x-slot>
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                          </svg>
                    </x-slot>
                    <x-slot:buttons>
                        <div class="space-x-3 flex items-center h-5">
                            <div class="w-full inline-flex items-center bg-white disabled:bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <input x-model="filter.search" x-on:keyup.enter="loadItems()" class="text-sm border-0 px-5 rounded-lg focus:ring-0" type="text" name="search" placeholder="Search">
                                <button x-on:click="loadItems()" type="button" class="px-3 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                      </svg>
                                </button>
                              </div>
                        </div>
                    </x-slot>
                    <x-slot:content ::class="{ 'opacity-50' : isLoading }">
                        <div class="overflow-x-auto">
                            <table id="table" class="min-w-full">
                                    <thead class="font-medium">
                                        <tr class="border-b-2 border-gray-300">
                                            <th scope="col" class="text-start py-3 px-5">
                                                {{ __('Type') }}
                                            </th>
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
                                                <td class="border-b py-3 px-5" x-text='item.type.name'></td>
                                                <td class="border-b py-3 px-5" x-text='getItemFullName(item)'></td>
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
