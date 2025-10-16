{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <style>
    /* ===== Auth – Register (full-bleed, no-scroll, soft blue) ===== */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    html,
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    :root {
        --auth-bg-url: none;
    }

    .auth-page {
        min-height: 100svh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(180deg, rgba(99, 132, 255, .10), rgba(147, 197, 253, .12)),
            linear-gradient(120deg, #f6faff, #ffffff 40%, #f2f7ff);
    }

    .auth-page::before {
        content: "";
        position: absolute;
        inset: 0;
        background: var(--auth-bg-url) center/cover no-repeat;
        opacity: .25;
        filter: saturate(1.05) contrast(1.02);
        pointer-events: none;
        transform: translateZ(0);
    }

    .auth-card {
        width: min(96vw, 500px);
        border-radius: 18px;
        border: 1px solid rgba(37, 99, 235, .12);
        background: linear-gradient(180deg, rgba(255, 255, 255, .92), rgba(255, 255, 255, .88));
        box-shadow: 0 18px 60px rgba(2, 6, 23, .10);
        backdrop-filter: blur(6px);
        padding: clamp(18px, 3vw, 28px);
        margin: 16px;
    }

    .auth-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        font-weight: 800;
        color: #2563eb;
        text-decoration: none;
        letter-spacing: .2px;
    }

    .auth-brand::before {
        content: "";
        width: 24px;
        height: 24px;
        border-radius: 8px;
        background: conic-gradient(from 160deg, #3b82f6, #60a5fa, #93c5fd);
        box-shadow: 0 4px 12px rgba(59, 130, 246, .35), inset 0 -2px 5px rgba(255, 255, 255, .6);
    }

    .auth-title {
        margin: 0 0 4px;
        font-weight: 800;
        font-size: clamp(1.15rem, 2.2vw, 1.4rem);
        color: #0f1a2b;
    }

    .auth-subtitle {
        margin: 0 0 18px;
        color: #5b708f;
        font-size: .95rem;
    }

    .auth-card label,
    .auth-card .mb-4>label {
        display: block;
        font-weight: 600;
        color: #0f1a2b;
    }

    .auth-card input[type="text"],
    .auth-card input[type="email"],
    .auth-card input[type="password"] {
        width: 100%;
        height: 44px;
        border-radius: 12px;
        border: 1px solid #dbe7ff;
        background: #fbfdff;
        color: #0f1a2b;
        padding: 0 12px;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
        box-shadow: 0 1px 0 rgba(15, 23, 42, .02) inset;
    }

    .auth-card input::placeholder {
        color: #98a8c4;
    }

    .auth-card input:focus {
        border-color: #9cc3ff;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(79, 140, 255, .18);
    }

    .auth-link {
        color: #5276d9;
        text-decoration: none;
        font-size: .93rem;
    }

    .auth-link:hover {
        text-decoration: underline;
    }

    .auth-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 16px;
    }

    .auth-card button[type="submit"],
    .auth-card .btn-primary {
        appearance: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 42px;
        padding: 0 16px;
        border-radius: 12px;
        border: 1px solid #4f8cff;
        background: #4f8cff;
        color: #fff;
        font-weight: 700;
        letter-spacing: .2px;
        cursor: pointer;
        transition: filter .15s, transform .06s, box-shadow .15s;
        box-shadow: 0 8px 20px rgba(79, 140, 255, .20);
    }

    .auth-card button[type="submit"]:hover {
        filter: brightness(1.03);
    }

    .auth-card button[type="submit"]:active {
        transform: translateY(1px);
    }

    .auth-card button[type="submit"]:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(79, 140, 255, .25);
    }

    .auth-card .text-red-600,
    .auth-card .error,
    .auth-card [data-error="true"] {
        color: #dc2626;
        font-size: .9rem;
    }

    .auth-card .mb-4 {
        margin-bottom: 1rem;
    }

    @media (prefers-color-scheme: dark) {
        .auth-page {
            background:
                linear-gradient(180deg, rgba(79, 140, 255, .12), rgba(147, 197, 253, .10)),
                linear-gradient(120deg, #0c1426, #0a1222 40%, #0c1426);
        }

        .auth-card {
            background: linear-gradient(180deg, rgba(18, 26, 46, .76), rgba(18, 26, 46, .72));
            border-color: rgba(147, 197, 253, .18);
            box-shadow: 0 18px 60px rgba(0, 0, 0, .35);
        }

        .auth-card label {
            color: #e6eeff;
        }

        .auth-card input {
            background: rgba(255, 255, 255, .06);
            border-color: rgba(147, 197, 253, .25);
            color: #e8f0ff;
        }

        .auth-card input:focus {
            border-color: #6ea6ff;
            box-shadow: 0 0 0 4px rgba(79, 140, 255, .22);
        }

        .auth-link {
            color: #9db8ff;
        }
    }

    @media (max-width:540px) {
        .auth-card {
            margin: 12px;
            padding: 16px;
            border-radius: 16px;
        }
    }
    </style>

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