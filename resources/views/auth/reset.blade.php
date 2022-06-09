<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Coronatime</title>
</head>

<body class="flex h-[100vh] flex-col items-center">

    <a href="{{ route('home') }}"><img src="{{ asset('images/coronatimelogo.svg') }}" width="300" alt="coronatime"
            class="mt-10"></a>

    <div class="absolute top-[50%] flex flex-col items-center">
        <h1 class="mb-10 text-4xl font-bold">Reset Password</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-6">
                <label for="email" class="mb-2 block text-xs font-bold uppercase text-gray-700">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email"
                    class="value= w-[20rem] border border-[#E6E6E7] p-2 focus:border-gray-500 focus:outline-none"
                    {{ old('email') }}" required>

                @error('email')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="hover:bg-blur-500 h-[3rem] w-[20rem] rounded-xl bg-green-400 py-2 px-4 text-white">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</body>

</html>
