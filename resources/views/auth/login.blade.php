{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    @vite(['resources/css/login.css', 'resources/js/app.js'])
    <!-- Đặt ảnh nền trực tiếp tại đây bằng CSS variable -->
    <div class="auth-page"
        style="--auth-bg-url: url('https://media.istockphoto.com/id/2166041064/vi/anh/aerial-view-of-hoi-an-ancient-town-at-twilight-vietnam.jpg?s=612x612&amp;w=0&amp;k=20&amp;c=LYktXv6Szi9KiPJ21TJmZD-VNeZbVn5Ms431DNtGihk=');">
        <div class="auth-card">

            <a href="{{ route('home') }}" class="auth-brand">VietNamTravel</a>
            <h1 class="auth-title">Đăng nhập</h1>
            <p class="auth-subtitle">Chào mừng bạn quay lại VietNamTravel</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="auth-remember mb-4">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <label for="remember_me"><span>{{ __('Remember me') }}</span></label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                    <a class="auth-forgot" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>