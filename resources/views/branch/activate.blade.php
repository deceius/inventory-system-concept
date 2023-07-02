<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Activate Branch') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('The branch will be re-activated into the system. Users assigned to this branch will be given access to the system.') }}
        </p>
    </header>
    <form method="post" action="{{ $branch->url . '/activate' }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" style="success" text="{{ __('Activate') }}"></x-ui.button>
    </form>
</section>
