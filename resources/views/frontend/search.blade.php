@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
    $ads1_link = \App\Helpers\AppHelper::settings("ads_image1_link");
@endphp
<x-app-layout>
    <div class="px-4 pt-5 mx-auto banner min-h-30 max-w-7xl sm:px-6 lg:px-8">
        <div class="py-10 bg-center bg-cover rounded-lg"  style="background-image: url({{ asset('img/banner.jpg') }})">
            <h1 class="text-6xl text-center text-white font-bebas">{{ __("Search") }}</h1>
            <div class="flex justify-center text-sm text-center text-white">
                <a href="{{ url('/') }}" class="font-bold text-red-600">{{ __('Home') }}</a>
                    <svg class="w-3 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                <h3>{{ __("Search") }}</h3>
            </div>
        </div>
    </div>
    <div class="px-4 pt-5 mx-auto mt-5 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-0 md:gap-4 xl:gap-4 md:grid-cols-4 xl:grid-cols-4">
            <div class="col-span-3">
                <div id="posts">
                    @if ($matches->count()>0 )
                        <h3 class="mt-5 mb-5 text-4xl text-center font-bebas dark:text-white text-bold ">{{ __('Matches') }}</h3>
                        <x-widgets.matches-type1 :matches="$matches" class="mt-5 mb-5 football" :title="''" />
                    @endif

                    @if ($posts->count()>0)
                        <h3 class="mt-5 mb-5 text-4xl text-center font-bebas dark:text-white text-bold ">{{ __('Posts') }}</h3>
                        @foreach ($posts as $post)
                            <x-widgets.post-card :post="$post" />
                        @endforeach
                    @endif
                </div>

            </div>
            <div class="latest-news">
                <x-widgets.tags-list :tags="$tags"/>
                <div class="mt-5 mb-5 ads-1">
                    <a href="{{ $ads1_link }}" target="_blank">
                    <img class="w-full rounded" src="{{ asset('storage/'.$ads1) }}" alt="ads-1">
                    </a>
                </div>
                <x-blog-post-list :posts="$latest" :title="'LATEST NEWS'" />
            </div>

        </div>
    </div>
</x-app-layout>
