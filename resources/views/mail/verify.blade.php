@extends('components.layout')
@section('content')
    <div class="absolute top-[50%] flex flex-col items-center">
        <img src="{{ asset('images/checkmark.svg') }}" width="100" alt="checkmark">
        <p class="p-5">{{ $message }}</p>
        <form style="display: {{ $form ? 'initial' : 'none' }}" method="POST" action="{{ route('home', $slug) }}">
            @csrf
            <button type="submit" class="rounded-xl bg-green-400 p-5 text-white">
                {{ $linkMessage }}
            </button>
        </form>
        <a class="rounded-xl bg-green-400 p-5 text-white" style="display:{{ $link ? 'initial' : 'none' }}"
            href="{{ route('login', $slug) }}">{{ $linkMessage }}</a>
    </div>
@endsection
