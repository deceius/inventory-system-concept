<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deactivate User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('User will not be able to access the system once deactivated. No transactional data will be deleted / modified upon user deactivation.') }}
        </p>
    </header>

    <form method="post" action="{{ $user->url . '/deactivate' }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" style="danger" text="{{ __('Deactivate') }}">
    </x-ui.button>
    </form>
</section>
