<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MaryUi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">
{{-- The navbar with `sticky` and `full-width` --}}
<x-mary-nav sticky full-width>

    <x-slot:brand>
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-mary-icon name="o-bars-3" class="cursor-pointer"/>
        </label>
        <div class="px-3 py-2 font-semibold">ChatForIncognito</div>
    </x-slot:brand>

     Right side actions
    <x-slot:actions>
        <livewire:chat.user-live-counter/>
        <x-mary-theme-toggle class="btn"/>
        <livewire:locale.set-locale-component/>
    </x-slot:actions>
</x-mary-nav>
<x-mary-main full-width>

    <x-slot:sidebar drawer="main-drawer" class="h-[calc(100vh-5rem)] bg-base-300">

        {{-- User --}}
        @if($user = auth()->user())
            <x-mary-list-item :item="$user" value="name" no-separator no-hover class="pt-2 text-2xl">
                <x-slot:actions>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-mary-button icon="o-power"
                                       class="btn-circle btn-ghost btn-xs"
                                       tooltip-left="logoff"
                                       type="submit"/>
                    </form>

                </x-slot:actions>

            </x-mary-list-item>
            <livewire:user.user-display-sidebar/>
            <x-mary-menu-separator/>
        @endif

        {{-- Activates the menu item when a route matches the `link` property --}}
        <x-mary-menu activate-by-route>
{{--            <x-mary-menu-item title="Home" icon="o-home" link="###"/>--}}
{{--            <x-mary-menu-item title="Messages" icon="o-envelope" link="###"/>--}}
{{--            <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">--}}
{{--                <x-mary-menu-item title="Wifi" icon="o-wifi" link="####"/>--}}
{{--                <x-mary-menu-item title="Archives" icon="o-archive-box" link="####"/>--}}
{{--            </x-mary-menu-sub>--}}
            @if(Route::currentRouteName() == 'chat')
                <livewire:chat.sidebar-filters>
            @endif

        </x-mary-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content class="p-1">
        {{ $slot }}

    </x-slot:content>
</x-mary-main>
<div class="bg-base-300" >
    <div class="pt-4 text-center text-xs text-base-content/40 border-t border-base-200">
        ChatForIncognito• Wersja 0<br>
        © 2025 Wszystkie prawa zastrzeżone
    </div>
    <div class="pb-4 flex justify-center text-center"><a href="{{route('terms')}}" class="uppercase font-semibold">{{__('welcome.form.terms_link')}}</a></div>
</div>

<x-mary-toast />
</body>
</html>
