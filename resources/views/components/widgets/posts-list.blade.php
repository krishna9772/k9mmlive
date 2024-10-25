@props(['posts','title'])

<div class="p-3">
    <h5 class="mb-5 text-2xl tracking-tight text-gray-900 font-bebas dark:text-white">{{ __($title) }}</h5>
    @foreach ($posts as $post)
        <div class="flex flex-col mb-5 md:flex-row">
            <img class="object-cover my-auto mb-3 rounded-lg w-60 h-60 me-2" src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="{{ $post->title }}">
            <div>
                <h2 class="font-semibold">
                    <a href="{{ route('frontend.posts.show', $post->slug) }}" class="text-gray-900 dark:text-white">{{ $post->title }}</a>
                </h2>
                <x-widgets.post-info :post="$post"/>
                <div class="mt-3 text-sm dark:text-white">
                    {!! Str::limit( strip_tags($post->body), 240, ' ...') !!}
                </div>
            </div>
        </div>
    @endforeach
    <div>
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
