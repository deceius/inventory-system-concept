<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Branch Master Data') }}">
            <x-slot:icon>
                <x-icons.branch-group/>
            </x-slot>
            <x-slot:buttons>
                <x-ui.button.link href="{{ route('admin.branch.create') }}" style="success" text="{{ __('Create Branch') }}">
                    <x-slot:icon>
                        <x-icons.button.create/>
                    </x-slot>
                </x-ui.button.link>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div x-data="branchIndex" x-init="loadBranches()">
        <x-ui.toolbar >
            <div class="space-x-3 flex items-center h-5">
                <x-ui.search click-method="reloadBranches()" model="filter.search" />
            </div>
            <label for="remember_me" class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" x-model="filter.inactive">
                <span class="ml-2 text-sm text-gray-600">{{ __('Show Inactive Branches') }}</span>
            </label>
        </x-ui.toolbar>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <template x-if="!isLoading && !result.data.length">
                    <x-custom.no-data data="{{ __('Branch')}}"></x-custom.no-data>
                </template>
                <div class="grid md:grid-cols-3 gap-4 grid-cols-1">
                    <template x-for="item in result.data">
                        <x-ui.card ::class="{ 'opacity-50' : !item.is_active }">
                            <x-slot:title>
                                <span x-text="item.name"></span>
                            </x-slot>
                            <x-slot:icon>
                                <x-icons.branch/>
                            </x-slot>
                            <x-slot:buttons>
                                <x-ui.button.link ::href="item.url + '/edit'" style="secondary" text="{{ __('Edit Branch') }}" x-show="item.is_active">
                                    <x-slot:icon>
                                        <x-icons.button.cog/>
                                    </x-slot>
                                </x-ui.button.link>
                                <form method="post" :action="item.url + '/activate'">
                                    @csrf
                                    @method('PATCH')
                                    <x-ui.button type="submit" style="success" text="{{ __('Activate') }}" x-show="!item.is_active">
                                        <x-slot:icon>
                                            <x-icons.button.check/>
                                        </x-slot>
                                    </x-ui.button>
                                </form>
                            </x-slot>
                            <x-slot:content >
                                <div class="space-y-2">
                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <x-icons.button.home/>
                                            <span x-text="item.address"></span>
                                        </div>
                                    </div>


                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <x-icons.button.doc-text/>
                                            <span x-text="item.tin"></span>
                                        </div>
                                    </div>
                                </div>
                            </x-slot>
                        </x-ui.card>
                    </template>
            </div>
            <div class="w-full flex justify-end mt-6" x-show="result.last_page > 1">

            </div>
        </div>
    </div>

</x-app-layout>
