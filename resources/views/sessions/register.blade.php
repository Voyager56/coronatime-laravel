@extends('welcome')
@section('content')
    <section class="my-10 flex flex-col">
        <h1 class="py-5 text-3xl font-bold">
            {{ __('welcome_to') }}
        </h1>
        <p class="pb-5 text-xl text-gray-500">
            {{ __('enter_fields') }}
        </p>


        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-6">
                <label for="username"
                    class="mb-2 block text-xs font-bold uppercase text-gray-700">{{ __('username') }}</label>
                <div class="relative flex w-fit">
                    <input type="text" name="username" id="username" placeholder="{{ __('enter_username') }}"
                        class="w-[20rem] border p-2 focus:border-blue-700 focus:outline-none"
                        style="border-color: {{ old('username') ? (!$errors->has('username') ? 'green' : 'red') : 'blue' }}"
                        value="{{ old('username') }}" required>
                    <x-success :errors="$errors" field="username" />
                </div>
            </div>
            @error('username')
                <div class="flex items-center">
                    <img src="{{ asset('images/error.png') }}" width="20" alt="">
                    <p class="ml-1 text-xs italic text-red-500">{{ $message }}</p>
                </div>
            @enderror

            <div class="mb-6">
                <label for="email" class="mb-2 block text-xs font-bold uppercase text-gray-700"> {{ __('email') }}</label>
                <div class="relative flex w-fit">
                    <input type="text" name="email" id="email" placeholder="{{ __('enter_email') }}"
                        class="w-[20rem] border p-2 focus:border-blue-700 focus:outline-none"
                        style="border-color: {{ old('email') ? (!$errors->has('email') ? 'green' : 'red') : 'blue' }}"
                        value="{{ old('email') }}" required>
                    <x-success :errors="$errors" field="email" />
                </div>
                @error('email')
                    <div class="flex items-center">
                        <img src="{{ asset('images/error.png') }}" width="20" alt="">
                        <p class="ml-1 text-xs italic text-red-500">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="mb-2 block text-xs font-bold uppercase text-gray-700">
                    {{ __('password') }}</label>
                <div class="relative flex w-fit">
                    <input type="password" name="password" id="password" placeholder="{{ __('enter_password') }}"
                        class="w-[20rem] border p-2 focus:border-blue-700 focus:outline-none"
                        style="border-color: {{ $errors->has('password') ? 'red' : 'blue' }}"
                        value="{{ old('password') }}" required>
                </div>
                @error('password')
                    <div class="flex items-center">
                        <img src="{{ asset('images/error.png') }}" width="20" alt="">
                        <p class="ml-1 text-xs italic text-red-500">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="mb-2 block text-xs font-bold uppercase text-gray-700">
                    {{ __('repeat_password') }}</label>
                <div class="relative flex w-fit">

                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="{{ __('repeat_password') }}"
                        class="w-[20rem] border p-2 focus:border-blue-700 focus:outline-none"
                        style="border-color: {{ $errors->has('password_confirmed') ? 'red' : 'blue' }}"
                        value="{{ old('password_confirmation') }}" required>
                </div>
                @error('password_confirmation')
                    <div class="flex items-center">
                        <img src="{{ asset('images/error.png') }}" width="20" alt="">
                        <p class="ml-1 text-xs italic text-red-500">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit"
                    class="hover:bg-blur-500 h-[3rem] w-[20rem] rounded-xl bg-green-400 py-2 px-4 text-white">
                    {{ __('sign_up') }}
                </button>
            </div>
        </form>


        <div class="flex">
            <p class="px-5"> {{ __('have_account?') }}</p>
            <a class="font-bold" href="{{ route('login') }}"> {{ __('log_in') }}</a>
        </div>
    </section>
@endsection
