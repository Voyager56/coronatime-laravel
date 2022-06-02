@extends('welcome')
@section('content')
    <section class="my-10 flex flex-col">
        <h1 class="py-5 text-3xl font-bold">
            {{ __('welcome-to') }}
        </h1>
        <p class="pb-5 text-xl text-gray-500">
            {{ __('enter-fields') }}
        </p>

        @if (old('form-sent'))
            <div class="text-slim fixed bottom-3 right-3 rounded-xl bg-green-400 p-3 text-white">
                <p>sent</p>
            </div>
        @endif

        <form method="POST" action="/signup">
            @csrf
            <div class="mb-6">
                <label for="username"
                    class="mb-2 block text-xs font-bold uppercase text-gray-700">{{ __('username') }}</label>
                <input type="text" name="username" id="username" placeholder="{{ __('enter-username') }}"
                    class="@error('username') border-red-400 @enderror w-[20rem] border border-blue-400 p-2 focus:border-blue-700 focus:outline-none"
                    value="{{ old('username') }}" required>
            </div>
            @error('username')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
            @enderror

            <div class="mb-6">
                <label for="email" class="mb-2 block text-xs font-bold uppercase text-gray-700"> {{ __('email') }}</label>
                <input type="text" name="email" id="email" placeholder="{{ __('enter-email') }}"
                    class="@error('email') border-red-400 @enderror w-[20rem] border border-blue-400 p-2 focus:border-blue-700 focus:outline-none"
                    value="{{ old('email') }}" required>

                @error('email')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="mb-2 block text-xs font-bold uppercase text-gray-700">
                    {{ __('password') }}</label>
                <input type="password" name="password" id="password" placeholder="{{ __('enter-password') }}"
                    class="@error('password') border-red-400 @enderror w-[20rem] border border-blue-400 p-2 focus:border-blue-700 focus:outline-none"
                    value="{{ old('password') }}" required>

                @error('password')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="mb-2 block text-xs font-bold uppercase text-gray-700">
                    {{ __('repeat-password') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="{{ __('repeat-password') }}"
                    class="@error('password-confirmation') border-red-400 @enderror w-[20rem] border border-blue-400 p-2 focus:border-blue-700 focus:outline-none"
                    value="{{ old('repeat-password') }}" required>

                @error('password_confirmation')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="hidden">
                <input name="form-sent" value="true">
            </div>

            <div class="mb-6">
                <button type="submit"
                    class="hover:bg-blur-500 h-[3rem] w-[20rem] rounded-xl bg-green-400 py-2 px-4 text-white">
                    {{ __('sign-up') }}
                </button>
            </div>
        </form>

        <div class="flex">
            <p class="px-5"> {{ __('have-account?') }}</p>
            <a class="font-bold" href="{{ route('login') }}"> {{ __('log-in') }}</a>
        </div>
    </section>
@endsection
