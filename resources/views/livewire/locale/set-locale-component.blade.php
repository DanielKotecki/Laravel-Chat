<div class="dropdown dropdown-end">
    <div tabindex="0" role="button" class="btn btn-ghost border-base-300 pl-2 pr-3 gap-2">
        @if(app()->getLocale() === 'pl')
            <img src="https://flagcdn.com/w40/pl.png" alt="PL"
                 class="w-6 h-auto rounded-sm shadow-sm">
            <span class="font-bold text-sm">PL</span>
        @elseif(app()->getLocale() === 'en')
            <img src="https://flagcdn.com/w40/gb.png" alt="EN"
                 class="w-6 h-auto rounded-sm shadow-sm">
            <span class="font-bold text-sm">EN</span>
        @elseif(app()->getLocale() === 'fr')
            <img src="https://flagcdn.com/w40/fr.png" alt="FR"
                 class="w-6 h-auto rounded-sm shadow-sm">
            <span class="font-bold text-sm">FR</span>
        @elseif(app()->getLocale() === 'de')
            <img src="https://flagcdn.com/w40/de.png" alt="DE"
                 class="w-6 h-auto rounded-sm shadow-sm">
            <span class="font-bold text-sm">DE</span>
        @else
            <img src="https://flagcdn.com/w40/gb.png" alt="EN"
                 class="w-6 h-auto rounded-sm shadow-sm">
            <span class="font-bold text-sm">EN</span>
        @endif

        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70 ml-1" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7"/>
        </svg>
    </div>

    <ul tabindex="0"
        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-36 border border-base-200">
        <li>
            <a href="{{ route('locale.set', ['lang' => 'pl']) }}"
               class="flex items-center gap-3 {{ app()->getLocale() === 'pl' ? 'bg-base-200 font-bold' : '' }}">
                <img src="https://flagcdn.com/w40/pl.png" alt="PL" class="w-5 h-auto rounded-sm">
                PL
            </a>
        </li>
        <li>
            <a href="{{ route('locale.set', ['lang' => 'en']) }}"
               class="flex items-center gap-3 {{ app()->getLocale() === 'en' ? 'bg-base-200 font-bold' : '' }}">
                <img src="https://flagcdn.com/w40/gb.png" alt="EN" class="w-5 h-auto rounded-sm">
                EN
            </a>
        </li>
        <li>
            <a href="{{ route('locale.set', ['lang' => 'fr']) }}"
               class="flex items-center gap-3 {{ app()->getLocale() === 'fr' ? 'bg-base-200 font-bold' : '' }}">
                <img src="https://flagcdn.com/w40/fr.png" alt="FR" class="w-5 h-auto rounded-sm">
                FR
            </a>
        </li>
        <li>
            <a href="{{ route('locale.set', ['lang' => 'de']) }}"
               class="flex items-center gap-3 {{ app()->getLocale() === 'de' ? 'bg-base-200 font-bold' : '' }}">
                <img src="https://flagcdn.com/w40/de.png" alt="DE" class="w-5 h-auto rounded-sm">
                DE
            </a>
        </li>
    </ul>
</div>
