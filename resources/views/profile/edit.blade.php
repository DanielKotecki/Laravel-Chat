<x-app-layout>
    {{-- Nagłówek Sekcji (Header) --}}
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- Główna Zawartość --}}
    <div class="py-8 lg:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Karta 1: Informacje Profilu --}}
            <div class="card card-compact lg:card-normal bg-base-100 shadow-xl">
                <div class="card-body p-4 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Karta 2: Aktualizacja Hasła --}}
            <div class="card card-compact lg:card-normal bg-base-100 shadow-xl">
                <div class="card-body p-4 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Karta 3: Usuwanie Konta --}}
            <div class="card card-compact lg:card-normal bg-base-100 shadow-xl">
                <div class="card-body p-4 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
