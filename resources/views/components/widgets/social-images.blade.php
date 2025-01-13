@props(['socials','title'])
@php
    $lang 
@endphp
<div  {{ $attributes->merge(['class'=>'max-w-sm']) }}>
    <h5 class="mb-2 text-2xl tracking-tight text-gray-900 font-bebas dark:text-white">{{ __($title) }}</h5>
    @foreach ($socials as $social)
        <a href="{{ $social->link }}">            
            <img class="w-full my-auto rounded-lg me-2" src="{{ $social->imageLink() }}" alt="{{ $social->name }}">
        </a>
    @endforeach
</div>
