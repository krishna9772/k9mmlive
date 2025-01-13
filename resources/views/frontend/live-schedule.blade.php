@php
    $ads1 = \App\Helpers\AppHelper::settings("ads_image1");
    $ads1_link = \App\Helpers\AppHelper::settings("ads_image1_link");
@endphp
<x-app-layout>
    <div class="px-4 pt-5 mx-auto banner min-h-30 max-w-7xl sm:px-6 lg:px-8">
        <div class="py-10 bg-center bg-cover rounded-lg"  style="background-image: url({{ asset('img/banner.jpg') }})">
            <h1 class="text-6xl text-center text-white font-bebas">{{ __('Live Schedule') }}</h1>
            <div class="flex justify-center text-sm text-center text-white">
                <a href="{{ url('/') }}" class="font-bold text-red-600">{{ __('Home') }}</a>
                    <svg class="w-3 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                <h3>{{ __('Live Schedule') }}</h3>
            </div>
        </div>
    </div>
    <div class="px-4 pt-5 mx-auto mt-5 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-0 md:gap-4 xl:gap-4 md:grid-cols-4 xl:grid-cols-4">
            <div class="col-span-3">
                <div id='data-navigation'>
                    <div class="flex justify-center">
                        <div class="mr-auto">
                            <button class="p-1 text-white rounded cursor-pointer hover:bg-gray-500 dark:hover:bg-gray-700 dark:text-black bg-dark-color dark:bg-white" data-date="{{ $date->addDays(-1)->format('m/d/Y') }}">
                                <x-icon name="fas-arrow-left" class=""  width="15" height="15" />
                            </button>
                        </div>
                        <div class="mx-2 text-gray-500 uppercase cursor-pointer font-bebas" data-date="{{ $date->addDays(-1)->format('m/d/Y') }}">
                            <x-widgets.day :date="$date->addDays(-1)"/>
                        </div>
                        <div class="mx-2 uppercase cursor-pointer dark:text-white font-bebas" data-date="{{ $date->format('m/d/Y') }}">
                            <x-widgets.day :date="$date"/>
                        </div>
                        <div class="mx-2 text-gray-500 uppercase cursor-pointer font-bebas" data-date="{{ $date->addDays(1)->format('m/d/Y') }}">
                            <x-widgets.day :date="$date->addDays(1)"/>
                        </div>
                        <div class="ml-auto">
                            <button class="p-1 text-white rounded cursor-pointer hover:bg-gray-500 dark:hover:bg-gray-700 dark:text-black bg-dark-color dark:bg-white" data-date="{{ $date->addDays(1)->format('m/d/Y') }}">
                                <x-icon name="fas-arrow-right"  width="15" height="15" />
                            </button>
                        </div>
                    </div>
                </div>
                    <x-widgets.matches-type1 :matches="$footballs" class="mt-5 football" :title="__('FOOTBALL')" />

                    <x-widgets.matches-type1 :matches="$boxings" class="mt-5 boxing" :title="__('BOXING')" />

                    <x-widgets.matches-type1 :matches="$esports" class="mt-5 esport" :title="__('ESPORTS')" />
                    <x-widgets.matches-type1 :matches="$futsals" class="mt-5 esport" :title="__('FUTSAL')" />
                    
            </div>
            <div class="latest-news">
                <div class="mb-5">
                    <div id="datepicker"></div>
                </div>
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
    @push('js')
        <script>
            const datepickerEl = document.getElementById('datepicker');
                let picker = new Datepicker(datepickerEl, {
                    autoSelectToday:true,
                    inline: true,
                    autohide: false,
                // options
                });
            picker.setDate("{{ $date->format('m/d/Y') }}");
            $(document).on('click','#datepicker [data-date]',function(){
                let date = Date.parse(picker.getDate());
                date = dayjs(date).format('MM/DD/YYYY');
                window.location.replace("/live-schedule?date="+date);

            });
            $(document).on('click','#data-navigation [data-date]',function(){
                window.location.replace("/live-schedule?date="+$(this).data('date'));
            });

        </script>
    @endpush
</x-app-layout>
