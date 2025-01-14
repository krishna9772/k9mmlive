@props(['post'])

<div class="flex flex-col mb-5 md:flex-row">
    <img class="object-cover my-auto mb-3 rounded-lg w-457 h-60 me-2" src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="{{ $post->title }}">
    <div>
        <h2 class="font-semibold">
            <a href="{{ lang_route('frontend.posts.show', ['slug'=>$post->slug]) }}" class="text-gray-900 dark:text-white">{{ $post->title }}</a>
        </h2>
        <x-widgets.post-info :post="$post"/>
        <div class="mt-3 text-sm dark:text-white">
            {!! Str::limit( strip_tags($post->body), 240, ' ...') !!}
        </div>
    </div>
</div>
