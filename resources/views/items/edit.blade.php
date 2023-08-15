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

        </div>
    </div>
</x-app-layout>
