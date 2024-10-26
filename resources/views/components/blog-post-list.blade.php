@props(['posts','title'])

<div class="max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-2xl tracking-tight text-gray-900 font-bebas dark:text-white">{{ __($title) }}</h5>
    @foreach ($posts as $post)
        <div class="flex p-2 mb-2 border border-gray-200 rounded-lg shadow dark:border-gray-700 post bg-alice-blue-color dark:bg-dark-alice-blue-color">
            <img class="object-cover w-16 h-16 my-auto rounded-lg me-2" src="{{ $post->featurePhoto }}" alt="{{ $post->title }}">
            <div class="title">
                @foreach ($post->tags as $tag)
                    <span class="text-xs text-gray-500">
                        {{ $tag->name }}
                    </span>
                @endforeach
                <a href="{{ route('frontend.posts.show', $post->slug) }}" class="text-lg text-gray-900 font-bebas dark:text-white">
                    <p class="text-sm text-gray-900 dark:text-white line-clamp-3">{{ $post->title }}</p>
                </a>
                <div class="flex mt-2 text-xs text-gray-500">
                    @if ($post->user)
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <div class="my-auto ml-1 text-xs">
                                {{ ucfirst($post->user?->name) }}
                            </div>
                        </div>
                    @endif
                    <div class="flex ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div class="my-auto ml-1 text-xs">
                            {{ $post->published_at->diffForHumans(now(),true,true)." ".__('ago') }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    @endforeach
</div>
