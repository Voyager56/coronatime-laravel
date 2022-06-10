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
                <div class="relative flex w-fit">
                    <input type="text" name="username" id="username" class="w-[20rem] rounded-xl border p-2"
                        style="border-color: {{ old('username') ? (!$errors->has('username') ? 'green' : 'red') : 'blue' }}"
                        value="{{ old('username') }}" required>
                    <x-success :errors="$errors" field="username" />
                </div>
                @error('username')
                    <x-error message="{{ $message }}" />
                @enderror
            </div>
            <div class="mb-6">
                <label for="password"
                    class="mb-2 block text-xs font-bold uppercase text-gray-700">{{ __('password') }}</label>
                <div class="relative flex w-fit">
                    <input type="password" name="password" id="password" class="w-[20rem] rounded-xl border p-2" required
                        style="border-color: {{ $errors->has('password') ? 'red' : 'blue' }}">
                </div>

                @error('password')
                    <x-error message="{{ $message }}" />
                @enderror
            </div>
            <div class="flex">
                <div class="mb-6 flex w-[15rem] items-start">
                    <input type="checkbox" name="remember" id="remember" class="rounded-xl border border-gray-400">
                    <label for="remember"
                        class="ml-5 mb-2 block text-xs font-bold uppercase text-gray-700">{{ __('remember') }}</label>
                </div>
                <a class="text-xs text-blue-400"
                    href="{{ route('forgot-password.page') }}">{{ __('forgot-passowrd') }}</a>
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="hover:bg-blur-500 h-[3rem] w-[20rem] rounded-xl bg-green-400 py-2 px-4 text-white">
                    {{ __('log-in') }}
                </button>
            </div>
            <div class="flex">
                <p class="px-5">{{ __('account?') }}</p>
                <a class="font-bold" href="{{ route('register') }}">{{ __('sign-up') }}</a>
            </div>
        </form>
    </section>
@endsection
