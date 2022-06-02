@extends('welcome')
@section('content')
    <section class="my-10 flex flex-col">
        <h2 class="py-5 text-3xl font-bold">{{ __('welcome') }}</h2>
        <p class="pb-5 text-xl text-gray-500">{{ __('enter-details') }}</p>

        <form method="POST" action="{{ route('login.store') }}">

            @csrf



            <div class="mb-6">
                <label for="username"
                    class="text-black-700 mb-2 block text-xs font-bold uppercase">{{ __('username') }}</label>
                <input type="text" name="username" id="username"
                    class="@error('username') border-red-400 @enderror w-[20rem] rounded-xl border border-gray-400 p-2"
                    value="" required>

                @error('username')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password"
                    class="mb-2 block text-xs font-bold uppercase text-gray-700">{{ __('password') }}</label>
                <input type="password" name="password" id="password"
                    class="@error('password') border-red-400 @enderror w-[20rem] rounded-xl border border-gray-400 p-2"
                    required>

                @error('password')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex">
                <div class="mb-6 flex w-[15rem] items-start">
                    <input type="checkbox" name="remember" id="remember" class="rounded-xl border border-gray-400">
                    <label for="remember"
                        class="ml-5 mb-2 block text-xs font-bold uppercase text-gray-700">{{ __('remember') }}</label>
                </div>
                <a class="text-xs text-blue-400" href="/forgot-password">{{ __('forgot-passowrd') }}</a>
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="hover:bg-blur-500 h-[3rem] w-[20rem] rounded-xl bg-green-400 py-2 px-4 text-white">
                    {{ __('log-in') }}
                </button>
            </div>
            <div class="flex">
                <p class="px-5">{{ __('account?') }}</p>
                <a class="font-bold" href="/signup">{{ __('sign-up') }}</a>
            </div>
        </form>
    </section>
@endsection
