@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
@endphp
<x-app-layout>
    <div class="px-4 pt-5 mx-auto banner min-h-30 max-w-7xl sm:px-6 lg:px-8">
        <div class="py-10 bg-center bg-cover rounded-lg"  style="background-image: url({{ asset('img/banner.jpg') }})">
            <h1 class="text-6xl text-center text-white font-bebas">{{ __('Who We Are') }}</h1>
            <div class="flex justify-center text-sm text-center text-white">
                <a href="{{ url('/') }}" class="font-bold text-red-600">{{ __('Home') }}</a>
                    <svg class="w-3 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                <h3>{{ __('About Us') }}</h3>
            </div>
        </div>
    </div>
    <div class="px-4 pt-5 mx-auto mt-5 text-center max-w-7xl sm:px-6 lg:px-8">
        <h3 class="text-3xl font-bebas dark:text-white">{{ $post->title }}</h3>
        <div class="text-sm text-gray-500">
            {{ $post->sub_title }}
        </div>
        <div class="mt-5 text-md dark:text-white">
            {!! $post->body !!}
        </div>
    </div>
</x-app-layout>
