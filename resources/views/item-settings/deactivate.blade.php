<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deactivate Item Type') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('This item type will not be available for use on new items. Previously assigned item types are unaffected.') }}
        </p>
    </header>

    <form method="post" action="{{ $itemType->url . '/deactivate' }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" style="danger" text="{{ __('Deactivate') }}">
    </x-ui.button>
    </form>
</section>
