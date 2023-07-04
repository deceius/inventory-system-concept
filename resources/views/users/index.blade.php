<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="{{ __('User Management') }}">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                  </svg>
            </x-slot>
            <x-slot name="buttons">
                <x-ui.button-link href="{{ route('admin.users.create') }}" style="success" text="{{ __('Create User') }}">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 018 18a9.953 9.953 0 01-5.385-1.572zM16.25 5.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                          </svg>

                    </x-slot>
                </x-ui.button-link>
            </x-slot>
        </x-ui.page-header>
    </x-slot>
    <div x-data="userIndex" x-init="loadUsers()">
        <x-ui.toolbar>
            <div class="space-x-3 flex items-center h-5">
                <div class="w-full inline-flex items-center bg-white disabled:bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <input x-model="filter.search" x-on:keyup.enter="reloadUsers()" class="text-sm border-0 px-5 rounded-lg focus:ring-0" type="text" name="search" placeholder="Search">
                    <button x-on:click="reloadUsers()" type="button" class="px-3 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                          </svg>
                    </button>
                  </div>
                  <x-ui.select x-model="filter.branch" class="w-full hidden md:block" x-on:change="reloadUsers()">
                    <option value="">All Branches</option>
                    @foreach ($branches as $branch)
                        <option value="{{$branch->id}}">{{ $branch->name }}</option>
                    @endforeach
                  </x-ui.select>
            </div>
            <label for="remember_me" class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" x-model="filter.inactive">
                <span class="ml-2 text-sm text-gray-600">{{ __('Hide Inactive Users') }}</span>
            </label>
        </x-ui.toolbar>
        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <template x-if="!isLoading && !data.length">
                    <x-ui.no-data data="{{ __('User')}}"></x-ui.no-data>
                </template>
                <template x-if="isLoading">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @for ($i = 0; $i < $count; $i++)
                            <x-ui.users-loading></x-ui.users-loading>
                        @endfor
                    </div>
                </template>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <template x-for="item in data">
                        <x-ui.card ::class="{ 'opacity-50' : !item.is_active }">
                            <x-slot name="title">
                                <span x-text="item.name"></span>
                            </x-slot>
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                  </svg>

                            </x-slot>
                            <x-slot name="buttons">
                                <x-ui.button-link ::href="item.url + '/edit'" style="secondary" text="{{ __('Edit User') }}" x-show="item.is_active">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path d="M13.024 9.25c.47 0 .827-.433.637-.863a4 4 0 00-4.094-2.364c-.468.05-.665.576-.43.984l1.08 1.868a.75.75 0 00.649.375h2.158zM7.84 7.758c-.236-.408-.79-.5-1.068-.12A3.982 3.982 0 006 10c0 .884.287 1.7.772 2.363.278.38.832.287 1.068-.12l1.078-1.868a.75.75 0 000-.75L7.839 7.758zM9.138 12.993c-.235.408-.039.934.43.984a4 4 0 004.094-2.364c.19-.43-.168-.863-.638-.863h-2.158a.75.75 0 00-.65.375l-1.078 1.868z" />
                                            <path fill-rule="evenodd" d="M14.13 4.347l.644-1.117a.75.75 0 00-1.299-.75l-.644 1.116a6.954 6.954 0 00-2.081-.556V1.75a.75.75 0 00-1.5 0v1.29a6.954 6.954 0 00-2.081.556L6.525 2.48a.75.75 0 10-1.3.75l.645 1.117A7.04 7.04 0 004.347 5.87L3.23 5.225a.75.75 0 10-.75 1.3l1.116.644A6.954 6.954 0 003.04 9.25H1.75a.75.75 0 000 1.5h1.29c.078.733.27 1.433.556 2.081l-1.116.645a.75.75 0 10.75 1.298l1.117-.644a7.04 7.04 0 001.523 1.523l-.645 1.117a.75.75 0 101.3.75l.644-1.116a6.954 6.954 0 002.081.556v1.29a.75.75 0 001.5 0v-1.29a6.954 6.954 0 002.081-.556l.645 1.116a.75.75 0 001.299-.75l-.645-1.117a7.042 7.042 0 001.523-1.523l1.117.644a.75.75 0 00.75-1.298l-1.116-.645a6.954 6.954 0 00.556-2.081h1.29a.75.75 0 000-1.5h-1.29a6.954 6.954 0 00-.556-2.081l1.116-.644a.75.75 0 00-.75-1.3l-1.117.645a7.04 7.04 0 00-1.524-1.523zM10 4.5a5.475 5.475 0 00-2.781.754A5.527 5.527 0 005.22 7.277 5.475 5.475 0 004.5 10a5.475 5.475 0 00.752 2.777 5.527 5.527 0 002.028 2.004c.802.458 1.73.719 2.72.719a5.474 5.474 0 002.78-.753 5.527 5.527 0 002.001-2.027c.458-.802.719-1.73.719-2.72a5.475 5.475 0 00-.753-2.78 5.528 5.528 0 00-2.028-2.002A5.475 5.475 0 0010 4.5z" clip-rule="evenodd" />
                                        </svg>
                                    </x-slot>
                                </x-ui.button-link>
                                <form method="post" :action="item.url + '/activate'">
                                    @csrf
                                    @method('PATCH')
                                    <x-ui.button type="submit" style="success" text="{{ __('Activate') }}" x-show="!item.is_active">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                              </svg>
                                        </x-slot>
                                    </x-ui.button>
                                </form>
                            </x-slot>
                            <x-slot name="content" >
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


            </div>
        </div>
    </div>

</x-app-layout>
