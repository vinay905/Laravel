<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2 style="text-align: center;color:red;">{{session('error')}}</h2>
    <form method="POST" action="{{ route('checklogin') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <h2 style="text-align: center;color:red;">{{session('completed')}}</h2>
        <div class="flex mt-4 text-center">
        <x-primary-button class="ms-3">
                {{ __('user login') }}
            </x-primary-button>
            <a href="{{route('signgoogle')}}">
                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;height: 40px;border-radius: 12px">
                </a>
            <div class="items-center justify-end mt-4">
                
            </div>
        </div>
    </form>
</x-guest-layout>


