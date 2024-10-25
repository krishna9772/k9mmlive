@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
@endphp
<x-app-layout>
    <div class="px-4 pt-5 mx-auto min-h-30 max-w-7xl sm:px-6 lg:px-8">
        <div class="py-10 bg-center bg-cover rounded-lg"  style="background-image: url({{ asset('img/banner.jpg') }})">
            <h1 class="text-6xl text-center text-white font-bebas">{{ $parent->name }}</h1>
            <div class="flex justify-center text-sm text-center text-white">
                <a href="{{ url('/') }}" class="font-bold text-red-600">Home</a>
                    <svg class="w-3 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                <h3>{{ $parent->name }}</h3>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 px-4 pt-5 mx-auto mt-5 max-w-7xl sm:px-6 lg:px-8">
        @if ($trendings)
            <div class="w-32 col-span-12 px-2 py-1 text-xl text-center text-white rounded-md shadow sm:col-span-2 font-bebas bg-gradient-to-l from-red-900 to-red-600">
                {{ __('TRENDING NOW') }}
            </div>
            <div class="self-center col-span-12 sm:col-span-10">
                <x-widgets.trending-slider>
                    @foreach ($trendings as   $new)
                        <div class="swiper-slide dark:text-white">
                            {{ $new->title }}
                        </div>
                    @endforeach
                </x-image-slider>
            </div>
        @endif
    </div>
    <div class="px-4 pt-5 mx-auto mt-5 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-0 md:gap-4 xl:gap-4 md:grid-cols-4 xl:grid-cols-4">
            <div class="col-span-3">
                @if ($is_video)
                    <x-widgets.video-posts-list :posts="$posts" :title="__($parent->name)"/>
                @else
                    <x-widgets.posts-list :posts="$posts" :title="__($parent->name)"/>
                @endif
            </div>
            <div class="latest-news">
                <x-widgets.tags-list :tags="$tags"/>
                <div class="mt-5 mb-5 ads-1">
                    <img class="w-full rounded" src="{{ asset('storage/'.$ads1) }}" alt="ads-1">
                </div>
                <x-blog-post-list :posts="$latest" :title="'LATEST NEWS'" />
            </div>

        </div>
    </div>
</x-app-layout>

