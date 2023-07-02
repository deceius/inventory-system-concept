<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deactivate Branch') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once a branch has been deactivated, users who are assigned to the branch will not be able to access the system. However, no data will be deleted, and the branch can still be re-activated anytime.') }}
        </p>
    </header>

    <form method="post" action="{{ $branch->url . '/deactivate' }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" style="danger" text="{{ __('Deactivate') }}">
    </x-ui.button>
    </form>
</section>
