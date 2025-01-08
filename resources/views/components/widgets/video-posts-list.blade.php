@props(['posts','title'])

<div class="p-3">
    <h5 class="mb-5 text-2xl tracking-tight text-gray-900 font-bebas dark:text-white">{{ __($title) }}</h5>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        @foreach ($posts as $post)
        <div class="mb-5 md:flex-row">
            <a href="{{ route('frontend.posts.show', $post->slug) }}">
                <img class="object-cover w-full my-auto mb-3 rounded-lg h-40 me-2" src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="{{ $post->title }}">
            </a>
            <div>
                <h2 class="flex font-semibold">
                    <a href="{{ route('frontend.posts.show', $post->slug) }}" class="text-gray-900 dark:text-white">{{ $post->title }}</a>
                    <span class="self-center ml-auto">
                        <x-icon name="fas-ellipsis-vertical" class="ml-1"  width="5" height="20" />
                    </span>
                </h2>
                <x-widgets.post-info :post="$post"/>
            </div>
        </div>
    @endforeach
    </div>

    <div>
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
