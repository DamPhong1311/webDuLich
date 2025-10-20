{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
   
    @vite(['resources/css/register.css', 'resources/js/app.js'])

    <!-- Set nền bằng biến CSS. Bạn có thể thay URL ảnh tuỳ thích -->
    <div class="auth-page"
        style="--auth-bg-url: url('https://media.istockphoto.com/id/2166041064/vi/anh/aerial-view-of-hoi-an-ancient-town-at-twilight-vietnam.jpg?s=612x612&amp;w=0&amp;k=20&amp;c=LYktXv6Szi9KiPJ21TJmZD-VNeZbVn5Ms431DNtGihk=');">
        <div class="auth-card">

            <a href="{{ route('home') }}" class="auth-brand">VietNamTravel</a>
            <h1 class="auth-title">Đăng ký</h1>
            <p class="auth-subtitle">Tạo tài khoản để trải nghiệm VietNamTravel</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="auth-actions">
                    <a class="auth-link" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>