<?php
declare(strict_types=1);

namespace App\Livewire\Locale;

use Livewire\Component;

/**
 *
 */
class SetLocaleComponent extends Component
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.locale.set-locale-component');
    }
}
