@props(['matches','title'])
@if ($matches->count() > 0)
<div {{ $attributes->merge(['class'=>'']) }}>
    <div>
        <h1 class="text-2xl dark:text-white font-bebas font-weight-bold">{{ $title }}</h1>
    </div>

    <div class="mt-3 dark:text-white">
        @foreach ($matches as $match )
            <a target="{{$match->live_link? '_blank':'_self'}}" href="{{ $match->live_link ?:'#' }}" class="flex w-full px-1 py-2 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex self-center w-2/6 text-sm align-middle font-bebas ">
                    <img class="object-contain w-8 h-8 mr-3" src="{{ asset('storage/'.$match->sportTeam1->image) }}" alt="{{ $match->sportTeam1->name }}">
                    <div class="self-center text-xs align-middle">
                        {{ $match->sportTeam1->name }}
                    </div>
                </div>
                <div class="self-center w-16 text-sm text-center align-middle">
                    <span class="bg-gray-200 mx-2 font-bold font-bebas text-gray-800 text-md me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                        {{ $match->score1 }}:{{ $match->score2 }}
                    </span>
                </div>
                <div class="flex self-center w-2/6 text-sm align-middle ">
                    <img class="object-contain w-8 h-8 mr-3" src="{{ asset('storage/'.$match->sportTeam2->image) }}" alt="{{ $match->sportTeam2->name }}">
                    <div class="self-center text-xs align-middle font-bebas">
                        {{ $match->sportTeam2->name }}
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
