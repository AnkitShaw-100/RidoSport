<x-guest-layout>
    <div class="admin-login-card">
        <div class="admin-login-brand">
            <img src="{{ asset('images/logo/logo-re.png') }}" alt="RidoSports">
            <p>Admin Panel</p>
            <h1>Blog Management Login</h1>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-700" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">
                    {{ __('Back to website') }}
                </a>

                <button type="submit" class="admin-login-button">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>

    <style>
        .admin-login-card {
            background: #fff;
            border-top: 5px solid #d2a126;
            border-radius: 8px;
            box-shadow: 0 16px 40px rgba(17, 60, 42, .12);
            margin: -10px;
            padding: 10px 0 0;
        }

        .admin-login-brand {
            margin-bottom: 24px;
            text-align: center;
        }

        .admin-login-brand img {
            height: 58px;
            margin: 0 auto 12px;
        }

        .admin-login-brand p {
            color: #d2a126;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .1em;
            margin: 0 0 4px;
            text-transform: uppercase;
        }

        .admin-login-brand h1 {
            color: #113c2a;
            font-size: 24px;
            font-weight: 800;
            margin: 0;
        }

        .admin-login-button {
            background: #113c2a;
            border-radius: 6px;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            padding: 10px 18px;
        }
    </style>
</x-guest-layout>
