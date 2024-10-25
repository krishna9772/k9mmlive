@props(['types'])
@php
    $count = count($types);
@endphp
<div {{ $attributes->merge(['class'=>'']) }}>
    <div id="accordion-sport-type" data-accordion="collapse" class="" data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
        @foreach ($types as $id => $type)
        @php
            $last = $count == $id+1;
            $first = $id == 0;
        @endphp
        <div class="{{ !$first? "mt-3":"" }} ">
            <h2 id="accordion-sport-type-heading-{{$type->id}}" class="accordion-heading">
                <button type="button" class="flex items-center justify-between w-full gap-3 p-3 font-medium text-gray-500 bg-white border border-gray-200 dark:bg-gray-700 border-b-1 rtl:text-right rounded-xl dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-sport-type-body-{{$type->id}}" aria-expanded="{{ $first? 'true':'false' }}" aria-controls="accordion-sport-type-body-{{$type->id}}">
                    <span>{{$type->name}}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-sport-type-body-{{$type->id}}" class="hidden accordion-body" aria-labelledby="accordion-sport-type-heading-{{$type->id}}">
                <div class="p-3 bg-white border border-gray-200 rounded-b-xl dark:border-gray-700 dark:bg-gray-900">
                    @foreach ($type->sportLeagues as $league)
                        <a href="{{ url('leagues/'.$league->slug) }}" class="flex mt-3">
                            <img class="object-contain w-10 h-10 border border-black rounded-full" src="{{ $league->image }}"/>
                            <div class="inline-block my-auto text-sm font-medium align-middle dark:text-white ps-3">
                                {{ $league->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
  </div>
</div>
