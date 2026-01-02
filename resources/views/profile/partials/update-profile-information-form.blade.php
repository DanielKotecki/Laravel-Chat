<section>
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        {{-- Pole Imię --}}
        <div class="form-control w-full">
            <label for="name" class="label">
                <span class="label-text">{{ __('Name') }}</span>
            </label>
            <input id="name" name="name" type="text" placeholder="{{ __('Name') }}"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="input input-bordered w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Pole Email --}}
        <div class="form-control w-full">
            <label for="email" class="label">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input id="email" name="email" type="email" placeholder="{{ __('Email') }}"
                   value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="input input-bordered w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link btn-xs p-0 min-h-0 h-auto">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div role="alert" class="alert alert-success mt-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ __('A new verification link has been sent to your email address.') }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Przyciski --}}
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
