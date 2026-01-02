<?php
declare(strict_types=1);
namespace App\Livewire\Chat;

use Livewire\Attributes\On;
use Livewire\Component;

/**
 *
 */
class UserLiveCounter extends Component
{
    /**
     * @var int
     */
    public int $userCount = 0;

    /**
     * @param $count
     * @return void
     */
    #[On('countUser')]
    public function countUser($count)
    {
        $this->userCount = $count;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.chat.user-live-counter');
    }

}
