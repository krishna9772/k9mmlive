@props(['matches','title'])
@if ($matches->count() > 0)
<div {{ $attributes->merge(['class'=>'']) }}>
    <div>
        <h1 class="text-2xl font-bebas dark:text-white font-weight-bold">{{ $title }}</h1>
    </div>
    <div class="mt-3 dark:text-white">
        @foreach ($matches as $match )
            <a href="{{ $match->live_url }}" class="flex w-full px-5 py-2 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="self-center align-middle w-14" style="font-size: 9px">
                    {{ date('H:iA d/m/Y',strtotime($match->date_time)) }}
                </div>
                <div class="flex self-center text-sm align-middle grow ">
                    <div class="grid self-center grid-cols-12 gap-1 text-xs align-middle grow font-bebas">
                        <div class="flex col-span-4">
                            <img class="object-contain w-8 h-8 mr-3" src="{{ asset('storage/'.$match->sportTeam1->image) }}" alt="{{ $match->sportTeam1->name }}">
                            <div class="self-center">
                                {{ $match->sportTeam1->name }}
                            </div>
                        </div>
                        <div class="self-center col-span-4 text-xl text-center">VS</div>
                        <div class="flex col-span-4">
                            <img class="object-contain w-8 h-8 mr-3" src="{{ asset('storage/'.$match->sportTeam2->image) }}" alt="{{ $match->sportTeam1->name }}">
                            <div class="self-center">
                                {{ $match->sportTeam2->name }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="self-center hidden ml-auto text-xs align-middle sm:w-40 sm:block">
                    <div>{{ $match->sportLeague->name }}</div>
                    <div class="text-md">{{ $match->sportStage->name }}</div>
                </div>
                <div class="self-center w-40 ml-auto text-xs align-middle sm:w-10">
                    <x-icon name="heroicon-o-chevron-right" class="ml-auto"  width="20" height="20" />
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif
