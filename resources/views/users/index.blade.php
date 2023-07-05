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
                  <x-ui.form.select x-model="filter.branch" class="w-full hidden md:block" x-on:change="reloadUsers()">
                    <option value="">All Branches</option>
                    @foreach ($branches as $branch)
                        <option value="{{$branch->id}}">{{ $branch->name }}</option>
                    @endforeach
                  </x-ui.form.select>
            </div>
            <label for="remember_me" class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" x-model="filter.inactive">
                <span class="ml-2 text-sm text-gray-600">{{ __('Show Inactive Users') }}</span>
            </label>
        </x-ui.toolbar>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <template x-if="!isLoading && !result.data.length">
                    <x-custom.no-data data="{{ __('User')}}"></x-custom.no-data>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm14.25 6a.75.75 0 01-.22.53l-2.25 2.25a.75.75 0 11-1.06-1.06L15.44 12l-1.72-1.72a.75.75 0 111.06-1.06l2.25 2.25c.141.14.22.331.22.53zm-10.28-.53a.75.75 0 000 1.06l2.25 2.25a.75.75 0 101.06-1.06L8.56 12l1.72-1.72a.75.75 0 10-1.06-1.06l-2.25 2.25z" clip-rule="evenodd" />
                                              </svg>
                                                <span x-text="item.email"></span>
                                        </div>
                                    </div>

                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 000 1.5v16.5h-.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5h-.75V3.75a.75.75 0 000-1.5h-15zM9 6a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm-.75 3.75A.75.75 0 019 9h1.5a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM9 12a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm3.75-5.25A.75.75 0 0113.5 6H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM13.5 9a.75.75 0 000 1.5H15A.75.75 0 0015 9h-1.5zm-.75 3.75a.75.75 0 01.75-.75H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM9 19.5v-2.25a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v2.25a.75.75 0 01-.75.75h-4.5A.75.75 0 019 19.5z" clip-rule="evenodd" />
                                              </svg>

                                                <span x-text="item.branch.name"></span>
                                        </div>
                                    </div>


                                    <div class="flex justify-between h-5 items-center">
                                        <div class="flex space-x-2 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path d="M18.75 12.75h1.5a.75.75 0 000-1.5h-1.5a.75.75 0 000 1.5zM12 6a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 0112 6zM12 18a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 0112 18zM3.75 6.75h1.5a.75.75 0 100-1.5h-1.5a.75.75 0 000 1.5zM5.25 18.75h-1.5a.75.75 0 010-1.5h1.5a.75.75 0 010 1.5zM3 12a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 013 12zM9 3.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zM12.75 12a2.25 2.25 0 114.5 0 2.25 2.25 0 01-4.5 0zM9 15.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
                                              </svg>

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
