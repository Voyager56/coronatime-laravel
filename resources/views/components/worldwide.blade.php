@extends('components.dashboard')
@section('content')
    <h1 class="mt-20 ml-[8rem] text-4xl font-bold">{{ __('worldwide') . ' ' . __('statistics') }}</h1>
    <x-dashboardrouting class="ml-[8rem] pt-5" active="worldwide" />
    <div class="mt-20 flex items-end justify-around">
        <div class="flex flex-col items-center justify-center rounded-xl bg-blue-300/[0.3] p-[8rem]">
            <img src="{{ asset('images/cases.png') }}" width="100" alt="">
            <div class="py-5 text-center font-bold">
                {{ __('new-cases') }}
            </div>
            <div class="text-center font-bold">
                {{ $stats['confirmed'] }}
            </div>
        </div>

        <div class="flex flex-col items-center justify-center bg-green-300/[0.3] p-[8rem]">
            <img src=" {{ asset('images/recovered.png') }}" width="100" alt="">
            <div class="py-5 text-center font-bold">
                {{ __('recovered') }}
            </div>
            <div class="text-center font-bold">
                {{ $stats['recovered'] }}
            </div>
        </div>
        <div class="flex flex-col items-center justify-center bg-yellow-300/[0.1] p-[8rem]">
            <img src=" {{ asset('images/death.png') }}" width="100" alt="">
            <div class="py-5 text-center font-bold">
                {{ __('deaths') }}
            </div>
            <div class="text-center font-bold">
                {{ $stats['deaths'] }}
            </div>
        </div>
    </div>
@endsection
