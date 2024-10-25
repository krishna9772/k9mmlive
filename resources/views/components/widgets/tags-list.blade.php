@props(['tags'])

<div  {{ $attributes->merge(['class'=>'max-w-sm']) }}>
    @foreach ($tags as $tag)
        <a href="{{ url('/tag/'.$tag->slug) }}" class="px-3 py-1 m-1 text-sm font-bold text-gray-800 bg-gray-300 border border-gray-300 rounded-full shadow" href="#">{{ $tag->name }}</a>
    @endforeach
</div>
