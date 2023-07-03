<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm']) }}>
    <div class="text-gray-900 py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
        {{ $slot }}
    </div>
</div>
