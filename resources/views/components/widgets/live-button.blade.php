@props(['text','active','icon','url'])
<a href="{{ $url }}" class=" flex {{ $active ? 'flex text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-2.5 py-1 text-center me-2 mb-2 dark:focus:ring-red-900' : 'px-2.5 py-1 mb-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700' }}">
    @if ($icon)
        <x-icon name="heroicon-s-signal" class="mr-1"  width="20" height="20" />
    @endif
    {{ __($text) }}
</a>
