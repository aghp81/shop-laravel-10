<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.generate') }}">
            @csrf

            <div>
                <x-label for="otp" value="{{ __('Mobile Number') }}" />
                <x-input id="otp" class="block mt-1 w-full" type="text" name="otp" :value="old('otp')" required autofocus autocomplete="otp" placeholder="شماره موبایل خود را وارد کنید" />
            </div>

            



            <div class="flex items-center justify-end mt-4">
                @if (Route::has('login'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
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
