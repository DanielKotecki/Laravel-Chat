{{--<x-layouts.guest>--}}
{{--    <div class="max-w-md mx-auto">--}}
{{--        <!-- Session Status – np. "Link do resetu hasła został wysłany" -->--}}
{{--        @if (session('status'))--}}
{{--            <x-mary-alert class="mb-6" type="success" icon="o-check-circle">--}}
{{--                {{ session('status') }}--}}
{{--            </x-mary-alert>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}" class="space-y-6">--}}
{{--            @csrf--}}

{{--            <!-- Email -->--}}
{{--            <x-mary-input--}}
{{--                label="Email"--}}
{{--                type="email"--}}
{{--                name="email"--}}
{{--                :value="old('email')"--}}
{{--                required--}}
{{--                autofocus--}}
{{--                autocomplete="username"--}}
{{--                hint="{{ $errors->first('email') }}"--}}
{{--            />--}}

{{--            <!-- Hasło -->--}}
{{--            <x-mary-input--}}
{{--                label="Hasło"--}}
{{--                type="password"--}}
{{--                name="password"--}}
{{--                required--}}
{{--                autocomplete="current-password"--}}
{{--                hint="{{ $errors->first('password') }}"--}}
{{--            />--}}

{{--            <!-- Zapamiętaj mnie -->--}}
{{--            <div class="flex items-center gap-3">--}}
{{--                <x-mary-checkbox name="remember" label="Zapamiętaj mnie" />--}}
{{--            </div>--}}

{{--            <!-- Przycisk logowania + link "Zapomniałem hasła" -->--}}
{{--            <div class="flex items-center justify-between pt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a href="{{ route('password.request') }}"--}}
{{--                       class="text-sm text-gray-600 hover:text-gray-900 underline">--}}
{{--                        {{ __('Zapomniałeś hasła?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-mary-button type="submit" class="px-8">--}}
{{--                    {{ __('Zaloguj się') }}--}}
{{--                </x-mary-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</x-layouts.guest>--}}
{{-- resources/views/auth/login.blade.php --}}
{{-- resources/views/auth/login.blade.php --}}
{{-- resources/views/auth/login.blade.php --}}
{{--<x-layouts.guest>--}}
{{--    --}}{{-- Używamy x-mary-card dla estetycznego kontenera --}}
{{--    <x-mary-card title="{{ __('Logowanie') }}" shadow class="!p-8 sm:!p-10">--}}

{{--        --}}{{-- Session Status – np. "Link do resetu hasła został wysłany" --}}
{{--        @if (session('status'))--}}
{{--            <x-mary-alert class="mb-6" type="success" icon="o-check-circle">--}}
{{--                {{ session('status') }}--}}
{{--            </x-mary-alert>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}" class="space-y-6">--}}
{{--            @csrf--}}

{{--            <x-mary-input--}}
{{--                label="Email"--}}
{{--                type="email"--}}
{{--                name="email"--}}
{{--                icon="o-envelope"--}}
{{--                :value="old('email')"--}}
{{--                required--}}
{{--                autofocus--}}
{{--                autocomplete="username"--}}
{{--                hint="{{ $errors->first('email') }}"--}}

{{--            />--}}

{{--            <x-mary-input--}}
{{--                label="Hasło"--}}
{{--                type="password"--}}
{{--                name="password"--}}
{{--                icon="o-lock-closed"--}}
{{--                required--}}
{{--                autocomplete="current-password"--}}
{{--                hint="{{ $errors->first('password') }}"--}}
{{--                error-class="bg-blue-500 p-1"--}}
{{--            />--}}

{{--            <div class="flex items-center justify-between">--}}
{{--                <x-mary-checkbox name="remember" label="Zapamiętaj mnie" />--}}

{{--                @if (Route::has('password.request'))--}}
{{--                    <a href="{{ route('password.request') }}" class="text-sm link link-primary">--}}
{{--                        {{ __('Zapomniałeś hasła?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            --}}{{-- btn-primary nadaje kolor motywu, w-full sprawia, że przycisk jest na całą szerokość --}}
{{--            <x-mary-button type="submit" class="w-full btn-primary" size="lg">--}}
{{--                {{ __('Zaloguj się') }}--}}
{{--            </x-mary-button>--}}
{{--        </form>--}}

{{--    </x-mary-card>--}}
{{--</x-layouts.guest>--}}
{{--<x-layouts.guest>--}}
{{--    <div class="max-w-md mx-auto">--}}
{{--        <!-- Session Status – np. "Link do resetu hasła został wysłany" -->--}}
{{--        @if (session('status'))--}}
{{--            <x-mary-alert class="mb-6" type="success" icon="o-check-circle">--}}
{{--                {{ session('status') }}--}}
{{--            </x-mary-alert>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}" class="space-y-6">--}}
{{--            @csrf--}}

{{--            <!-- Email -->--}}
{{--            <x-mary-input--}}
{{--                label="Email"--}}
{{--                type="email"--}}
{{--                name="email"--}}
{{--                :value="old('email')"--}}
{{--                required--}}
{{--                autofocus--}}
{{--                autocomplete="username"--}}
{{--                hint="{{ $errors->first('email') }}"--}}
{{--            />--}}

{{--            <!-- Hasło -->--}}
{{--            <x-mary-input--}}
{{--                label="Hasło"--}}
{{--                type="password"--}}
{{--                name="password"--}}
{{--                required--}}
{{--                autocomplete="current-password"--}}
{{--                hint="{{ $errors->first('password') }}"--}}
{{--            />--}}

{{--            <!-- Zapamiętaj mnie -->--}}
{{--            <div class="flex items-center gap-3">--}}
{{--                <x-mary-checkbox name="remember" label="Zapamiętaj mnie" />--}}
{{--            </div>--}}

{{--            <!-- Przycisk logowania + link "Zapomniałem hasła" -->--}}
{{--            <div class="flex items-center justify-between pt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a href="{{ route('password.request') }}"--}}
{{--                       class="text-sm text-gray-600 hover:text-gray-900 underline">--}}
{{--                        {{ __('Zapomniałeś hasła?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-mary-button type="submit" class="px-8">--}}
{{--                    {{ __('Zaloguj się') }}--}}
{{--                </x-mary-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</x-layouts.guest>--}}
{{-- resources/views/auth/login.blade.php --}}
{{-- resources/views/auth/login.blade.php --}}
{{-- resources/views/auth/login.blade.php --}}
{{--<x-layouts.guest>--}}
{{--    --}}{{-- Używamy x-mary-card dla estetycznego kontenera --}}
{{--    <x-mary-card title="{{ __('Logowanie') }}" shadow class="!p-8 sm:!p-10">--}}

{{--        --}}{{-- Session Status – np. "Link do resetu hasła został wysłany" --}}
{{--        @if (session('status'))--}}
{{--            <x-mary-alert class="mb-6" type="success" icon="o-check-circle">--}}
{{--                {{ session('status') }}--}}
{{--            </x-mary-alert>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}" class="space-y-6">--}}
{{--            @csrf--}}

{{--            <x-mary-input--}}
{{--                label="Email"--}}
{{--                type="email"--}}
{{--                name="email"--}}
{{--                icon="o-envelope"--}}
{{--                :value="old('email')"--}}
{{--                required--}}
{{--                autofocus--}}
{{--                autocomplete="username"--}}
{{--                hint="{{ $errors->first('email') }}"--}}

{{--            />--}}

{{--            <x-mary-input--}}
{{--                label="Hasło"--}}
{{--                type="password"--}}
{{--                name="password"--}}
{{--                icon="o-lock-closed"--}}
{{--                required--}}
{{--                autocomplete="current-password"--}}
{{--                hint="{{ $errors->first('password') }}"--}}
{{--                error-class="bg-blue-500 p-1"--}}
{{--            />--}}

{{--            <div class="flex items-center justify-between">--}}
{{--                <x-mary-checkbox name="remember" label="Zapamiętaj mnie" />--}}

{{--                @if (Route::has('password.request'))--}}
{{--                    <a href="{{ route('password.request') }}" class="text-sm link link-primary">--}}
{{--                        {{ __('Zapomniałeś hasła?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            --}}{{-- btn-primary nadaje kolor motywu, w-full sprawia, że przycisk jest na całą szerokość --}}
{{--            <x-mary-button type="submit" class="w-full btn-primary" size="lg">--}}
{{--                {{ __('Zaloguj się') }}--}}
{{--            </x-mary-button>--}}
{{--        </form>--}}

{{--    </x-mary-card>--}}
{{--</x-layouts.guest>--}}
{{-- resources/views/auth/login.blade.php --}}
{{-- resources/views/auth/login.blade.php --}}
<x-layouts.guest>
    <x-mary-card title="{{ __('Logowanie') }}" shadow class="!p-8 sm:!p-10">

        @if ($errors->any())
            {{-- ogólny alert (jeśli chcesz pokazać pierwszy błąd globalny) --}}
            <x-mary-alert class="mb-6 text-error" type="error"  icon="o-exclamation-triangle">
                {{ $errors->first() }}
            </x-mary-alert>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- EMAIL: error prop + slot + forced classes gdy błąd istnieje --}}
            <x-mary-input
                label="Email"
                type="email"
                name="email"
                icon="o-envelope"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                error="email"
                :class="$errors->has('email') ? 'input-error text-error' : ''"
            >

            </x-mary-input>
            @error('email')
            <x-mary-alert class=" text-error" type="error"  icon="o-exclamation-triangle">
                {{ $message }}
            </x-mary-alert>
            @enderror
            {{-- PASSWORD --}}
            <x-mary-input
                label="Hasło"
                type="password"
                name="password"
                icon="o-lock-closed"
                required
                autocomplete="current-password"
                error="password"
            >
                @error('password')
                <span class="text-red-600 block mt-1">{{ $message }}</span>
                @enderror
            </x-mary-input>

            <div class="flex items-center justify-between">
                <x-mary-checkbox name="remember" label="Zapamiętaj mnie" />

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm link link-primary">
                        {{ __('Zapomniałeś hasła?') }}
                    </a>
                @endif
            </div>

            <x-mary-button type="submit" class="w-full btn-primary" size="lg">
                {{ __('Zaloguj się') }}
            </x-mary-button>
        </form>

    </x-mary-card>
</x-layouts.guest>
