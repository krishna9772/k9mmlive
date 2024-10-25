@props(['matches','title'])
@if ($matches->count() > 0)
<div {{ $attributes->merge(['class'=>'']) }}>
    <div>
        <h1 class="text-2xl font-bebas dark:text-white font-weight-bold">{{ $title }}</h1>
    </div>
    <div class="mt-3 dark:text-white">
        @foreach ($matches as $match )
            <a href="#" class="flex w-full px-5 py-2 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex self-center w-2/3 text-sm align-middle ">

                    <div class="flex self-center text-xs align-middle font-bebas">
                        <div class="w-3 h-3">
                            @if ($match->live_now)
                                <x-icon name="fas-circle-dot" class="mt-0.5 mr-1 text-red-600"  width="10" height="10" />
                            @endif
                        </div>
                        {{ $match->sportLeague->name }} : {{ $match->sportTeam1->name }} VS {{ $match->sportTeam2->name }}
                    </div>
                </div>


                <div class="self-center ml-auto text-xs align-middle">
                    {{ date('d/m/Y H:iA',strtotime($match->date_time)) }}
                </div>
                <div class="self-center text-xs align-middle">
                    <x-icon name="heroicon-o-chevron-right"  width="20" height="20" />
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif
