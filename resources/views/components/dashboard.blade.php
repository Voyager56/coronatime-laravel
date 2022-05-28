<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Dashboard</title>
</head>

<body>

    <div class="mx-20 my-5 flex items-center justify-between">
        <a class="ml-10" href="{{ route('home') }}"><img src="{{ asset('images/coronatimelogo.svg') }}"
                alt=""></a>
        <div class="flex w-[20em] items-center justify-evenly">
            <x-langbuttons />
            <p class="font-bold text-black">
                {{ auth()->user()->username }}
            </p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-xl bg-green-400 py-2 px-4 text-white hover:bg-red-500">
                    Logout
                </button>
            </form>
        </div>
    </div>


    @yield('content')



</body>

</html>
