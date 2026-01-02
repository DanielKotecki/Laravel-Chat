<section class="space-y-4">
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Przycisk otwierający modal --}}
    {{-- Używamy atrybutu onclick dla DaisyUI modal --}}
    <button class="btn btn-error"
            onclick="document.getElementById('confirm_user_deletion_modal').showModal()">
        {{ __('Delete Account') }}
    </button>

    {{-- Modal DaisyUI --}}
    <dialog id="confirm_user_deletion_modal" class="modal"
            @if ($errors->userDeletion->isNotEmpty())
                open
        @endif>

        <form method="post" action="{{ route('profile.destroy') }}" class="modal-box p-6 space-y-4">
            @csrf
            @method('delete')

            <h3 class="font-bold text-lg text-error">
                {{ __('Are you sure you want to delete your account?') }}
            </h3>

            <p class="text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            {{-- Pole Hasło --}}
            <div class="form-control w-full pt-4">
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="input input-bordered w-full"
                    placeholder="{{ __('Password') }}"
                />
                {{-- Wyświetlanie błędu hasła, jeśli występuje --}}
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            {{-- Stopka Modalu (Przyciski) --}}
            <div class="modal-action">
                {{-- Przycisk Anuluj --}}
                <button type="button" class="btn" onclick="document.getElementById('confirm_user_deletion_modal').close()">
                    {{ __('Cancel') }}
                </button>

                {{-- Przycisk Usuń --}}
                <button type="submit" class="btn btn-error ms-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>

        {{-- Zamykanie modalu kliknięciem poza nim (DaisyUI backrop close) --}}
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</section>
