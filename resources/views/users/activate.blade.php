<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Activate User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('This user will be re-activated into the system. System access will now be enabled for this user.') }}
        </p>
    </header>
    <form method="post" action="{{ $user->url . '/activate' }}">
        @csrf
        @method('PATCH')
        <x-ui.button type="submit" style="success" text="{{ __('Activate') }}"></x-ui.button>
    </form>
</section>
