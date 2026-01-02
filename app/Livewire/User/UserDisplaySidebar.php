<?php
declare(strict_types=1);
namespace App\Livewire\User;

use App\Models\User;
use App\Repositories\UserChatRepositoryInterface;
use Livewire\Component;

/**
 *
 */
class UserDisplaySidebar extends Component
{

    /**
     * @var User|null
     */
    public ?User $user = null;

    /**
     * @param UserChatRepositoryInterface $userChatRepository
     * @return void
     */
    public function mount(UserChatRepositoryInterface $userChatRepository): void
    {
        $this->user = $userChatRepository->getAuthUser();

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.user.user-display-sidebar');
    }
}
