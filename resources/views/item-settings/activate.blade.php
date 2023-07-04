<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Activate Item Type') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('This item type will be activated. It can be assigned to new items.') }}
        </p>
    </header>
    <form method="post" action="{{ $itemType->url . '/activate' }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" style="success" text="{{ __('Activate') }}"></x-ui.button>
    </form>
</section>
