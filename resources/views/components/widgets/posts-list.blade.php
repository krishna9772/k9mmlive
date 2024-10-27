@props(['posts','title'])

<div class="p-3">
    <h5 class="mb-5 text-2xl tracking-tight text-gray-900 font-bebas dark:text-white">{{ __($title) }}</h5>
    @foreach ($posts as $post)
        <x-widgets.post-card :post="$post" />
    @endforeach
    <div>
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
