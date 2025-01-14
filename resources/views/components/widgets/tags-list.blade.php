@props(['tags'])

<div  {{ $attributes->merge(['class'=>'max-w-sm']) }}>
    @foreach ($tags as $tag)
        <a href="{{ lang_route('frontend.tags.show',['slug'=>$tag->slug]) }}" class="inline-block px-3 py-1 mt-1 mb-1 text-sm font-bold text-gray-800 bg-gray-300 border border-gray-300 rounded-full shadow hover:bg-gray-400" href="#">{{ __($tag->name) }}</a>
    @endforeach
</div>
