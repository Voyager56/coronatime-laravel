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


        <div class="ml-5 mt-20 flex w-[60vw] flex-col md:ml-20">
            <div class="flex w-[100vw] items-center">

                <a href=" {{ route('home') }}" class="w-10rem">
                    <img src="{{ asset('images/coronatimelogo.svg') }}" alt="coronatime"
                        class="w-[200px] md:w-[300px]">
                </a>


                <x-langbuttons class="ml-[100px] mr-10" />
            </div>
            @yield('content')
        </div>
        <img class="h-0 w-0 lg:h-[100vh] lg:w-[40vw]" src="{{ asset('images/background.jpg') }}" alt="coronatime">
    </div>

    @if (session()->has('message'))
        <div class="text-slim fixed bottom-3 right-3 rounded-xl bg-green-400 p-3 text-white">
            <p>{{ session('message') }}</p>
        </div>
    @endif

</body>

</html>
