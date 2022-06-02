@extends('components.dashboard')
@section('content')
    <h1 class="mt-20 ml-5 text-4xl font-bold md:ml-[8rem]">{{ __('worldwide') . ' ' . __('statistics') }}</h1>
    <x-dashboardrouting class="ml-5 pt-5 md:ml-[8rem]" active="worldwide" />
    <div class="grid-row-2 grid-col-6 mx-2 mt-20 grid gap-5 gap-x-0 lg:flex lg:items-end lg:justify-around">
        <div
            class="lg: col-span-4 flex w-[95vw] flex-col items-center justify-center rounded-xl bg-blue-300/[0.3] p-[3rem] md:h-[20rem] md:w-[20rem] md:p-[8rem]">
            <img src="{{ asset('images/cases.png') }}" width="100" alt="">
            <div class="py-5 text-center font-bold">
                {{ __('new-cases') }}
            </div>
            <div class="text-center font-bold">
                {{ $stats['confirmed'] }}
            </div>
        </div>
        <div
            class="col-span-2 row-span-1 flex w-[47vw] flex-col items-center justify-center rounded-xl bg-green-300/[0.3] p-[1rem] md:h-[20rem] md:w-[20rem] md:p-[8rem]">
            <img src=" {{ asset('images/recovered.png') }}" width="100" alt="">
            <div class="py-5 text-center font-bold">
                {{ __('recovered') }}
            </div>
            <div class="text-center font-bold">
                {{ $stats['recovered'] }}
            </div>
        </div>
        <div
            class="col-span-2 row-span-1 flex w-[47vw] flex-col items-center justify-center rounded-xl bg-yellow-300/[0.1] p-[1rem] md:h-[20rem] md:w-[20rem] md:p-[8rem]">
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
