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
                <div class="mt-3 dark:text-white">
                    {!! $post->body !!}
                </div>
                <div class="mt-5">
                    {!! $shareButton?->html_code !!}                
                </div>

                <div class="mt-5">
                    @if($post->comments->count())
                        <div class="border-t-2 py-10">
                            <div class="mb-4">
                                <h3 class="mb-2 text-2xl font-semibold">Comments</h3>
                            </div>
                            <div class="flex flex-col gap-y-6 divide-y">
                                @foreach($post->comments as $comment)
                                    @if($comment->user)
                                    <article class="pt-4 text-base">
                                        <div class="mb-4 flex items-center gap-4">
                                            <img class="h-14 w-14 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300" src="{{ asset($comment->user?->avatar) }}" alt="avatar">
                                            <div>

                                                <span class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold">
                                                    {{ $comment->user?->{config('filamentblog.user.columns.name')} }}
                                                </span>
                                                <span class="block whitespace-nowrap text-sm font-medium text-zinc-600">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                        <p class="text-gray-500">
                                            {{ $comment->comment }}
                                        </p>
                                    </article>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <x-widgets.comment :post="$post" />
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

