<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Coronatime</title>
</head>

<body>

    <div class="flex">


        <div class="ml-20 mt-20 flex w-[60vw] flex-col">
            <div class="flex items-center">

                <a href=" {{ route('home') }}" class="w-fit">
                    <img src="{{ asset('images/coronatimelogo.svg') }}" width="300" alt="coronatime"
                        class="">
                </a>
            </div>
            @yield('content')
        </div>
        <img class="h-[100vh] w-[40vw]" src="{{ asset('images/background.jpg') }}" alt="coronatime">
    </div>

    @if (session()->has('message'))
        <div class="text-slim fixed bottom-3 right-3 rounded-xl bg-green-400 p-3 text-white">
            <p>{{ session('message') }}</p>
        </div>
    @endif

</body>

</html>
