@props(['date'])
<div {{ $attributes->merge(['class'=>'']) }} >
    @if ($date->isToday())
        {{ __('Today') }}
    @elseif ($date->isTomorrow())
        {{ __('Tomorrow') }}
    @elseif ($date->isYesterday())
        {{ __('Yesterday') }}
    @else
        {{ $date->format('d M Y') }}
    @endif
</div>
