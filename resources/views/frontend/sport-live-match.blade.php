@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
@endphp
<x-app-layout>
    <div class="px-4 pt-5 mx-auto banner min-h-30 max-w-7xl sm:px-6 lg:px-8">
        <div class="">
            <div class="flex text-sm text-center dark:text-white ">
                <a href="{{ url('/') }}" class="font-bold text-red-600">{{ __('Home') }}</a>                 
                <svg class="w-3 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>
                <span>{{ $match->title }}</span>
            </div>
        </div>
    </div>
    <div class="px-4 pt-5 mx-auto mt-5 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-0 md:gap-4 xl:gap-4 md:grid-cols-4 xl:grid-cols-4">
            <div class="col-span-3">
                <h3 class="text-3xl font-bebas dark:text-white">{{ $match->title }}</h3>
                <div class="flex">
                    {!! $match->description !!}
                </div>
                @if ($match->live_embed)
                    <div class="mt-5">
                        {!! $match->live_embed !!}
                    </div>                    
                @endif                 
                <div class="mt-5">
                    {!! $shareButton?->html_code !!}                
                </div>
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
    {!! $shareButton?->script_code !!}
</x-app-layout>

