<?php
declare(strict_types=1);
namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 *
 */
#[Layout('components.layouts.guest')]
class TermsPage extends Component
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.terms-page');
    }
}
