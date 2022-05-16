@extends('welcome')
@section('content')

    <section class="py-20 flex flex-col justify-between h-[60vh]">
            <h2 class="text-2xl font-bold">Welcome Back</h2>
            <p>Welcome back! Please enter your details</p>     
            <form method="POST" action="/admin/login">

                @csrf

                <div class="mb-6">
                    <label for="username" class="block mb-2 uppercase font-bold text-xs text-black-700">Username:</label>
                    <input type="text" name="username" id="username" class="border border-gray-400 p-2 w-[20rem] rounded-xl" value=""  required>

                    @error('username')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="border border-gray-400 w-[20rem] p-2 rounded-xl" required>

                    @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex">
                    <div class="mb-6 w-[15rem] flex items-start">
                        <input type="checkbox" name="remember" id="remember" class="border border-gray-400  rounded-xl">
                        <label for="remember" class="ml-5 block mb-2 uppercase font-bold text-xs text-gray-700">Remember this device</label>
                    </div>
                    <a class="text-xs text-blue-400" href="/reset/password">Forgot Password?</a>
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-green-400 text-white rounded-xl py-2 px-4 w-[20rem] h-[3rem] hover:bg-blur-500">
                        Submit
                    </button>
                </div>
                <div class="flex ">
                    <p class="px-5">Don't Have An Account?</p>
                    <a class="font-bold" href="/signup">Sign Up!</a>
                </div>
            </form>
    </section>

@endsection
