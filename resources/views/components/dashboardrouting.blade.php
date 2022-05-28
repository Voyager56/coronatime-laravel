<div {{ $attributes->merge(['class' => 'w-[250px] flex justify-between']) }}>
    <a class="text-center text-2xl" href="{{ route('home') }}"
        style="color:  {{ $active === 'worldwide' ? 'black' : 'gray' }};   border-bottom: {{ $active === 'worldwide' ? '2px solid black' : 'none' }} ">{{ __('worldwide') }}</a>
    <a class="text-center text-2xl" href="{{ route('show') }}"
        style="color: {{ $active === 'country' ? 'black' : 'gray' }};   border-bottom:{{ $active === 'country' ? '2px solid black' : 'none' }} "">{{ __('country') }}</a>
</div>
