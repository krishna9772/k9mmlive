@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");

    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
    $ads1_link = \App\Helpers\AppHelper::settings("ads_image1_link");
    $params = request()->all();
    if(isset($params['lang'])) unset($params['lang']);
    if(isset($params['date'])) unset($params['date']);
    $dd = \Carbon\CarbonImmutable::now();
    $params['date']=$dd->format('Y-m-d');
    $today = http_build_query($params);
    $params['date']=$dd->addDays(1)->format('Y-m-d');
    $tomorrow = http_build_query($params);
    $params['date']=$dd->addDays(-1)->format('Y-m-d');
    $yesterday  =  http_build_query($params);

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
                            <a href="{{ $slider->link }}">
                                <x-image class="mx-auto" :src="$slider->image_path" :alt="$slider->title" />
                            </a>
                        </div>
                    @endforeach
                </x-image-slider>
                <div class="mt-4">
                    <div class="flex flex-col justify-between mb-3 md:flex-row">
                        <div class="flex">
                            <x-widgets.live-button :text="'Live'" :url="url('/')" :active="$date==null" :icon="true" />
                            <x-widgets.live-button :text="'Today'" :url="url('/').'?'.$today" :active="$date?->isToday()" :icon="false" />
                            <x-widgets.live-button :text="'Yesterday'" :url="url('/').'?'.$yesterday" :active="$date?->isYesterday()" :icon="false" />
                            <x-widgets.live-button :text="'Tomorrow'" :url="url('/').'?'.$tomorrow" :active="$date?->isTomorrow()" :icon="false" />
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
                    <a href="{{ $ads1_link }}" target="_blank">
                        <img class="w-full rounded" src="{{ asset('storage/'.$ads1) }}" alt="ads-1">
                    </a>
                </div>
                <x-blog-post-list :posts="$popular" :title="'TRENDING NEWS'" />
            </div>

        </div>
    </div>
</x-app-layout>

