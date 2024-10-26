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
                @if($category)
                    <a href="{{ url('/category/'.$category->slug) }}" class="font-bold text-red-600"> {{ $category->name }}</a>
                    <svg class="w-3 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                @endif
                <span>{{ $post->title }}</span>
            </div>
        </div>
    </div>
    <div class="px-4 pt-5 mx-auto mt-5 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-0 md:gap-4 xl:gap-4 md:grid-cols-4 xl:grid-cols-4">
            <div class="col-span-3">
                <h3 class="text-3xl font-bebas dark:text-white">{{ $post->title }}</h3>
                <div class="flex">
                    <x-widgets.post-info :post="$post"/>
                    <div class="ml-auto text-xs self-align-end">
                        @foreach ($post->tags as $tag)
                            <span class="px-2 py-1 mr-1 text-xs text-gray-500 bg-gray-200 rounded-md dark:bg-gray-700">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @if (!$is_video)
                    <div>
                        <img class="object-cover w-full mx-auto my-3 mt-5 mb-5 rounded-lg" src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="{{ $post->title }}">
                    </div>
                @endif
                <div class="mt-3">
                    {!! $post->body !!}
                </div>

            </div>
            <div class="latest-news">
                <div class="mb-5">
                    <div id="datepicker-inline" autoSelectToday=1 inline-datepicker data-date="{{ date("m/d/Y") }}"></div>
                </div>

                <x-widgets.tags-list :tags="$tags"/>
                <div class="mt-5 mb-5 ads-1">
                    <img class="w-full rounded" src="{{ asset('storage/'.$ads1) }}" alt="ads-1">
                </div>
                <x-blog-post-list :posts="$latest" :title="'LATEST NEWS'" />
            </div>

        </div>
    </div>
</x-app-layout>

