<x-app-layout>
    <x-slot:header>
        <x-ui.header title="{{ __('Edit Item') }}">
            <x-slot:icon>
                <x-icons.master-data/>
            </x-slot>

            <x-slot:prev-level>
                <span>{{ __('Master Data') }}</span>
                <x-icons.breadcrumb/>
                <a class="text-indigo-400 font-light underline" href="{{ route('items.index') }}">{{ __('Items') }}</a>
                <x-icons.breadcrumb/>
            </x-slot>
            <x-slot:buttons>
                @if (old('isActive', $item->is_active))
                    <x-custom.button.deactivate action="{{ $item->url . '/deactivate' }}" method="post" text="{{ __('Deactivate')}}"/>
                @else
                    <x-custom.button.activate action="{{ $item->url . '/activate' }}" method="post" text="{{ __('Activate')}}"/>
                @endif
            </x-slot>
        </x-ui.header>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-ui.card>
                <x-slot:title>{{ __('Item Information') }}</x-slot>
                <x-slot:icon>
                    <x-icons.form/>
                </x-slot>
                <x-slot:content>
                    <form method="POST" action="{{ $item->url . '/update' }}">
                        @csrf
                        @method('PATCH')
                        <!-- Name -->
                        <div>
                            <x-ui.form.input.label for="name" :value="__('Name')" />
                            <x-ui.form.input.text id="name" :value="old('name', $item->name)" class="block mt-1 w-full" type="text" name="name" required autofocus />
                            <x-ui.form.input.error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="brand_id" :value="__('Brand')" />
                            <x-ui.form.select id="brand_id"
                                        class="block mt-1 w-full"
                                        name="brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}" {{ $brand->id == old('brand_id', $item->brand_id) ? 'selected' : ''}}>{{ $brand->name }}</option>
                                @endforeach
                            </x-ui.form.select>
                            <x-ui.form.input.error :messages="$errors->get('brand_id')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-ui.form.input.label for="type_id" :value="__('Type')" />
                            <x-ui.form.select id="type_id"
                                        class="block mt-1 w-full"
                                        name="type_id">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}" {{ $type->id == old('type_id', $item->type_id) ? 'selected' : ''}}>{{ $type->name }}</option>
                                @endforeach
                            </x-ui.form.select>
                            <x-ui.form.input.error :messages="$errors->get('type_id')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            <x-ui.button type="submit" text="{{ __('Save') }}">
                            </x-ui.button>
                            @if (session('status') === 'updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Updated.') }}</p>
                            @endif
                        </div>
                    </form>
                </x-slot>
            </x-ui.card>
            <x-ui.card.table>
                <x-slot:title>
                    {{ __('Price Management') }}
                </x-slot>
                <x-slot:icon>
                    <x-icons.list/>
                </x-slot>
                <x-slot:buttons>
                    <x-ui.button style="success" text="{{ __('Add Branch Price') }}">
                        <x-slot:icon>
                            <x-icons.button.create/>
                        </x-slot>
                    </x-ui.button>
                </x-slot>
                <x-slot:content>
                    <div class="overflow-x-auto">
                        <table id="table" class="min-w-full">
                                <thead class="font-medium">
                                    <tr class="border-b-2 border-gray-300">
                                        <th scope="col" class="text-start py-3 px-5">
                                            {{ __('Branch') }}
                                        </th>
                                        <th scope="col" class="text-start py-3 px-5">
                                            {{ __('Box') }}
                                        </th>
                                        <th scope="col" class="text-start py-3 px-5">
                                            {{ __('Cutting') }}
                                        </th>
                                        <th scope="col" class="text-start py-3 px-5">
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-gray-300 text-start">
                                        <td class="border-t py-3 px-5">Main</td>
                                        <td class="border-t py-3 px-5">250.00</td>
                                        <td class="border-t py-3 px-5">364.00</td>
                                        <td class="border-t py-3 px-5"></td>
                                    </tr>
                                    <tr class="border-gray-300 text-start">
                                        <td class="border-t py-3 px-5">Main</td>
                                        <td class="border-t py-3 px-5">250.00</td>
                                        <td class="border-t py-3 px-5">364.00</td>
                                        <td class="border-t py-3 px-5"></td>
                                    </tr>
                                    {{-- <template x-for="item in result.data">
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
                                    </template> --}}
                                </tbody>
                            </table>
                    </div>
                </x-slot>
            </x-ui.card.table>
        </div>
    </div>
</x-app-layout>
