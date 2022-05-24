<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Coronatime</title>
</head>
<body class="flex flex-col items-center h-[100vh]">

    <a href="/"><img src="{{asset('images/coronatimelogo.svg')}}" width="300" alt="coronatime" class="mt-10"></a>

    @yield('content')

    @if (session()->has('message'))
        <div
            class="fixed bottom-3 right-3 rounded-xl bg-green-400 text-white text-slim p-3">
            <p>{{session('message')}}</p>
        </div>
    @endif  
</body>
</html>