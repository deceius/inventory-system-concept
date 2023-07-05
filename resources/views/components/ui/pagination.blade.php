@props(['links'])
<nav class="isolate -space-x-px rounded-md shadow-sm">
    <template x-for="(link, index) in {{ $links }}">
        <x-ui.pagination.link x-on:click="loadPage(link.url)" x-text="setPaginationLabel(link.label, index)" index="index" ::class="{ 'bg-white' : !link.active, 'bg-gray-900 text-white' : link.active, 'text-gray-900 hover:bg-gray-100' : !link.active, 'rounded-l-md' : index == 0, 'rounded-r-md' : index == result.data.length - 1 }" ></x-ui.pagination.link>
    </template>
</nav>
