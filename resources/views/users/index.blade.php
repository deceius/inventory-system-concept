<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('User Management') }}">
            <x-slot:icon>
                <x-icons.user-group/>
            </x-slot>
            <x-slot:buttons>
                <x-ui.button.link href="{{ route('admin.users.create') }}" style="success" text="{{ __('Create User') }}">
                    <x-slot:icon>
                        <x-icons.button.user-new/>
                    </x-slot>
                </x-ui.button.link>
            </x-slot>
        </x-ui.header>
    </x-slot>
    <div x-data="userIndex" x-init="loadUsers()">
        <x-ui.toolbar>
            <div class="space-x-3 flex items-center h-5">
                <x-ui.search click-method="reloadUsers()" model="filter.search" />
                @if(Auth::user()->access_tier == 1)
                    <x-ui.form.select x-model="filter.branch" class="w-full hidden md:block" x-on:change="reloadUsers()">
                        <option value="">All Branches</option>
                        @foreach ($branches as $branch)
                            <option value="{{$branch->id}}">{{ $branch->name }}</option>
                        @endforeach
                    </x-ui.form.select>
                  @endif
            </div>
            <label for="remember_me" class="inline-flex items-center self-end">
                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" x-model="filter.inactive">
                <span class="ml-2 text-sm text-gray-600">{{ __('Show Inactive Users') }}</span>
            </label>
        </x-ui.toolbar>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <template x-if="!isLoading && !result.data.length">
                    <x-custom.no-data data="{{ __('User') }}"></x-custom.no-data>
                </template>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <template x-for="item in result.data">
                        <x-ui.card ::class="{ 'opacity-50' : !item.is_active }">
                            <x-slot:title>
                                <span x-text="item.name"></span>
                            </x-slot>
                            <x-slot:icon>
                                <x-icons.user/>
                            </x-slot>
                            <x-slot:buttons>
                                <x-ui.button.link ::href="item.url + '/edit'" style="secondary" text="{{ __('Edit User') }}" x-show="item.is_active">
                                    <x-slot:icon>
                                        <x-icons.button.cog/>
                                    </x-slot>
                                </x-ui.button.link>
                                <form method="post" :action="item.url + '/activate'">
                                    @csrf
                                    @method('PATCH')
                                    <x-ui.button type="submit" style="success" text="{{ __('Activate') }}" x-show="!item.is_active">
                                        <x-icons.button.check/>
                                    </x-ui.button>
                                </form>
                            </x-slot>
                            <x-slot:content >
                                <div class="space-y-2">
                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <x-icons.button.code/>
                                            <span x-text="item.email"></span>
                                        </div>
                                    </div>

                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <x-icons.button.branch/>
                                            <span x-text="item.branch.name"></span>
                                        </div>
                                    </div>


                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <x-icons.button.adjust-h/>
                                            <span x-text="item.access_tier_string"></span>
                                        </div>
                                    </div>

                                </div>
                            </x-slot>

                        </x-ui.card>
                    </template>

                </div>
                <div class="w-full flex justify-end mt-6" x-show="result.last_page > 1">
                    <x-ui.pagination links="result.links"></x-ui.pagination>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
