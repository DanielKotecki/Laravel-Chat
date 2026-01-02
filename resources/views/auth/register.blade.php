<x-layouts.guest>
    <x-mary-card title="Zarejestruj się" subtitle="Utwórz nowe konto w kilka sekund" separator>
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Imię i nazwisko -->
            <x-mary-input
                label="Imię i nazwisko"
                name="name"
                type="text"
                icon="o-user"
                placeholder="Jan Kowalski"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />

            <!-- Email -->
            <x-mary-input
                label="Adres e-mail"
                name="email"
                type="email"
                icon="o-envelope"
                placeholder="jan@example.com"
                :value="old('email')"
                required
                autocomplete="username"
            />

            <!-- Hasło -->
            <x-mary-input
                label="Hasło"
                name="password"
                type="password"
                icon="o-lock-closed"
                placeholder="••••••••"
                required
                autocomplete="new-password"
                hint="Minimum 8 znaków"
            />

            <!-- Powtórz hasło -->
            <x-mary-input
                label="Powtórz hasło"
                name="password_confirmation"
                type="password"
                icon="o-lock-closed"
                placeholder="••••••••"
                required
                autocomplete="new-password"
            />

            <!-- Przyciski -->
            <div class="flex items-center justify-between pt-4">
{{--                <x-mary-link :href="route('login')" class="text-sm">--}}
{{--                    Masz już konto? Zaloguj się--}}
{{--                </x-mary-link>--}}

                <x-mary-button type="submit" class="px-8" size="lg" spinner>
                    Zarejestruj się
                </x-mary-button>
            </div>
        </form>
    </x-mary-card>
    </x-layouts.guest>
