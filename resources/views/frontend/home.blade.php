@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
@endphp
<x-app-layout>
    <div class="px-4 pt-5 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-0 md:gap-4 xl:gap-4 md:grid-cols-4 xl:grid-cols-4">
            <div>
                <x-widgets.type-accordion :types="$types"/>
                <x-widgets.social-images class="mt-5" :socials="$socials" title="FOLLOW US ON SOCIAL MEDIA" />

            </div>
            <div class="col-span-2">
                <x-image-slider>
                    @foreach ($sliders as   $slider)
                        <div class="swiper-slide">
                            <x-image class="mx-auto" :src="$slider->image_path" :alt="$slider->title" />
                        </div>
                    @endforeach
                </x-image-slider>
                <div class="mt-4">
                    <div class="flex flex-col justify-between mb-3 md:flex-row">
                        <div class="flex">
                            <button type="button" class="text-white flex bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-2.5 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                <x-icon name="heroicon-s-signal" class="mr-1"  width="20" height="20" /> {{ __('Live') }}
                            </button>

                            <button type="button" class="px-2.5 py-1 mb-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                {{ __('Today') }}
                            </button>
                            <button type="button" class="px-2.5 py-1 mb-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                {{ __('Yesterday') }}
                            </button>
                            <button type="button" class="px-2.5 py-1 mb-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                {{ __('Tomorrow') }}
                            </button>
                        </div>
                        <div class="flex text-sm font-bold dark:text-white md:w-100 sm:w-100">
                            <div  style="font-size:10px;line-height:10px;" class="mr-1">
                                <div class="text-right">{{ date('d M Y') }} <br/> {{ date('l') }}</div>
                            </div>
                            <x-icon name="fas-calendar"  width="20" height="20" />
                        </div>
                    </div>
                    <x-match-slider>
                        @for ($i = 0; $i < 3; $i++)
                            @foreach ($matches as $k=>$match)
                                <div class="swiper-slide" style="height: 100%">
                                    <x-widgets.match-card :match="$match" />
                                </div>
                            @endforeach
                        @endfor
                    </x-match-slider>

                    <x-widgets.matches-type1 :matches="App\Helpers\AppHelper::footBallMatches(null,5)" class="mt-5 football" :title="__('FOOTBALL')" />

                    <x-widgets.matches-type2 :matches="App\Helpers\AppHelper::boxingMatches(null,5)" class="mt-5 boxing" :title="__('BOXING')" />

                    <x-widgets.matches-type3 :matches="App\Helpers\AppHelper::esportMatches(null,5)" class="mt-5 esport" :title="__('ESPORTS')" />

                </div>
            </div>
            <div class="latest-news">
                <x-blog-post-list :posts="$latest" :title="'LATEST NEWS'" />
                <div class="mt-5 mb-5 ads-1">
                    <img class="w-full rounded" src="{{ asset('storage/'.$ads1) }}" alt="ads-1">
                </div>
                <x-blog-post-list :posts="$popular" :title="'TRENDING NEWS'" />
            </div>

        </div>
    </div>
</x-app-layout>

