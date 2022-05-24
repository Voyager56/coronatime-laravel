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

    <img src="{{asset('images/coronatimelogo.svg')}}" width="300" alt="coronatime" class="mt-10">

    <div  class="absolute top-[50%] flex flex-col items-center">
        <h1 class="text-4xl font-bold mb-10">Reset Password</h1>
        <form method="POST" action="/forgot-password">
            @csrf
            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email" class="border border-[#E6E6E7] w-[20rem] p-2 focus:border-gray-500 focus:outline-none value="{{old('email')}}"  required>

                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-green-400 text-white rounded-xl py-2 px-4 w-[20rem] h-[3rem] hover:bg-blur-500">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>