@extends('components.layout')
@section('content')
    <div  class="absolute top-[50%] flex flex-col items-center">
        <img src="{{asset('images/checkmark.svg')}}" width="100" alt="checkmark">
            <p class="p-5">{{$message}}</p>
            <form  style="display: {{$form? "initial" : "none"}}" method="POST" action="/{{$slug}}">
                @csrf
                <button type="submit" class="bg-green-400 p-5 rounded-xl text-white">
                    {{$linkMessage}}
                </button>
            </form>
            <a class="bg-green-400 p-5 rounded-xl text-white" style="display:{{$link? "initial":"none"}}" href="/{{$slug}}">{{$linkMessage}}</a>
    </div>
@endsection