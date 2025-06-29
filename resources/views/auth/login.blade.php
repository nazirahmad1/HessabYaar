

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    {{-- <h1 class="text-lg">به سیستم مدیریت حسابیار خوش آمدید</h1> --}}
    <form method="POST" action="{{ route('login') }}" style="direction:rtl;">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('نام کاربری')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمز عبور')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">

            <x-primary-button class="ms-3">
                {{ __('ورود') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>