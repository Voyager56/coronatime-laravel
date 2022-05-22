@extends('welcome')
@section('content')

    <section class="flex flex-col my-10">
        <h1 class="py-5 text-3xl font-bold">
            Welcome to Coronatime
        </h1>
        <p class="pb-5 text-gray-500 text-xl">
            Please enter required info to sign up
        </p>

        <form method="POST" action="/signup">

            @csrf

            <div class="mb-6">
                <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter unique username" class="border border-blue-400 w-[20rem] p-2 focus:border-blue-700 focus:outline-none" value="{{old('username')}}" required>


                @error('username')
                    <p class="text-gray-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email" class="border border-blue-400 w-[20rem] p-2 focus:border-blue-700 focus:outline-none value="{{old('email')}}"  required>

                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Fill in password" class="border border-blue-400 w-[20rem] p-2 focus:border-blue-700 focus:outline-none" required>

                @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">Repeat Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password" class="border w-[20rem] border-blue-400 p-2 focus:border-blue-700 focus:outline-none" value="{{old('repeat-password')}}"  required>

                @error('password_confirmation')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-green-400 text-white rounded-xl py-2 px-4 w-[20rem] h-[3rem] hover:bg-blur-500">
                    Submit
                </button>
            </div>
        </form>

        <div class="flex">
            <p class="px-5">Already have an account?</p>
            <a class="font-bold" href="/">Login!</a>
        </div>
    </section>

@endsection