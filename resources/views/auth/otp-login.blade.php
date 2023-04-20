<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 text-right">{{ __('OTP Login') }}</div>
        </div>


        @if (session('error'))
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"" role="alert"> {{session('error')}} 
                    </div>
                    
            </div>
        </div>
        @endif

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.generate') }}">
            @csrf

            <div class="text-right">
                <x-label for="mobile_no" value="{{ __('Mobile Number') }}" />
                <x-input id="mobile_no" type="text" class="block mt-1 w-full @error('mobile_no') is-invalid @enderror" name="mobile_no" required autocomplete="mobile_no"  :value="old('mobile_no')" required autofocus placeholder="شماره موبایل خود را وارد کنید" />
            
                @error('mobile_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
            </div>

            <div class="flex items-center justify-end mt-4 text-right">
                @if (Route::has('login'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-right" href="{{ route('login') }}">
                        {{ __('Login With Email') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Generate OTP') }}
                </x-button>
            </div>
            
        </form>
    </x-authentication-card>
</x-guest-layout>
