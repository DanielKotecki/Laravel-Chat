<?php
declare(strict_types=1);
namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;

/**
 *
 */
class ChatHeaderCard extends Component
{
    /**
     * @var User|null
     */
    public ?User $headerUser = null;
    /**
     * @var bool
     */
    public bool $displayHeader = false;

    /**
     * @return void
     */
    public function disconnect()
    {
        $this->dispatch('stopChatSubscription');
        $this->dispatch('chatDisconnectHeaderButton')->to(PageChat::class);
    }

    /**
     * @return void
     */
    public function nextPerson()
    {
        $this->dispatch('stopChatSubscription');
        $this->dispatch('chatNewPairHeaderButton')->to(PageChat::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.chat.chat-header-card');
    }
}
