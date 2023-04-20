<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 text-right">{{ __('OTP Login') }}</div>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-right text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if (session('success'))
        <div class="bg-teal-100 border-t-4 text-right border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <p class="text-sm"> {{session('success')}} </p>
        </div>
        @endif
  
        @if (session('error'))
        <div role="alert">
            <div class="bg-red-500 text-white font-bold text-right rounded-t px-4 py-2">
                خطا
            </div>
            <div class="border border-t-0 border-red-400 text-right rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>{{session('error')}} </p>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('otp.getlogin') }}">
            @csrf

            <x-input type="hidden" name="user_id" value="{{$user_id}}" />
            <div>
                <x-label for="otp" value="{{ __('OTP') }}" />
                <input id="otp" class="block text-right mt-1 w-full @error('otp') is-invalid @enderror" type="text" name="otp" value="{{ old('otp') }}" required autofocus autocomplete="otp" placeholder="پسورد یکبار مصرف را وارد کنید" />

                @error('otp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('login'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Login With Email') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Login') }}
                </x-button>
            </div>
            
        </form>
    </x-authentication-card>
</x-guest-layout>
