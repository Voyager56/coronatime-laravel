<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Coronatime</title>
</head>
<body>

    <div class="flex ">
{{-- 
        <button type="submit" form="logout-form">Log Out</button>
        <form id="logout-form" method="POST" action="/logout" class="hidden">
            @csrf
        </form> --}}

        <div class="w-[60vw] flex flex-col ml-20 mt-20">
            <a href="/" class="w-fit">
                <img src="{{asset('images/coronatimelogo.svg')}}" width="300" alt="coronatime" class=""> 
            </a>
            @yield('content')
        </div>
        <img class="h-[100vh] w-[40vw]" src="{{asset('images/background.jpg')}}" alt="coronatime">
    </div>
    
</body>
</html>