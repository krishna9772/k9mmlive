@props(['match'])
<div {{ $attributes->merge(["class"=>"flex flex-col h-full max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow flex-dir-row dark:bg-gray-800 dark:border-gray-700"]) }}>
    <div class="flex justify-center gap-4">
        <div>
            <img class="object-contain w-16 h-16" src="{{ asset('storage/'.$match->sportTeam1->image) }}" alt="{{ $match->sportTeam1->name }}">
        </div>
        <div class="flex text-center">
            <h5 class="my-auto mb-2 text-5xl font-bold tracking-tight text-gray-900 font-bebas dark:text-white">{{ date('H:i',strtotime($match->date_time)) }}</h5>
        </div>
        <div>
            <img class="object-contain w-16 h-16" src="{{ asset('storage/'.$match->sportTeam2->image) }}" alt="{{ $match->sportTeam2->name }}">
        </div>
    </div>
    <div class="grid items-stretch justify-center grid-cols-3 gap-4 mt-3 mb-3 dark:text-white">
        <div class="text-xs font-normal text-center font-bebas grow">
            {{ strtoupper($match->sportTeam1->name) }}
        </div>
        <div class="text-xs font-normal text-center font-inter grow">
            {{ $match->sportLeague->name }}
        </div>
        <div class="text-xs font-normal text-center font-bebas grow">
            {{ strtoupper($match->sportTeam2->name) }}
        </div>
    </div>
    <div class="self-end w-full mt-auto">
        @if ($match->live_now)
            <a target="{{$match->live_link? '_blank':'_self'}}" href="{{ $match->live_link ?: lang_route('frontend.sport.live-match',['slug'=>$match->slug])  }}">
                <button type="button" class="shadow-md w-full px-3 py-2 mb-2 font-medium text-center text-white bg-red-600 rounded-full hover:bg-red-400 focus:outline-none focus:ring-4 focus:ring-red-400 me-2 dark:bg-red-600 dark:hover:bg-red-700 font-bebas dark:focus:ring-red-400">{{ strtoupper(__('Watch Live')) }}</button>
            </a>
        @endif
    </div>
</div>
