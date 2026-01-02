<?php
declare(strict_types=1);

namespace App\Livewire\Chat;

use App\Events\PairFoundEvent;
use App\Models\User;
use App\Repositories\chat\ChatRepositoryInterface;
use App\Repositories\UserChatRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 *
 */
class PageChat extends Component
{
    /**
     * @var
     */
    public $users;
    /**
     * @var string
     */
    public string $mySessionId;
    /**
     * @var array
     */
    public array $onlineUsers;
    /**
     * @var string
     */
    public string $pairId;
    /**
     * @var User|null
     */
    #[Locked]
    public ?User $headerUser = null;
    /**
     * @var bool
     */
    #[Locked]
    public bool $displayHeader = false;
    /**
     * @var bool
     */
    #[Locked]
    public bool $isChatActive = false;
    /**
     * @var string
     */
    public string $partnerName = '';

    /**
     * @return array|string[]
     */
    protected function getListeners(): array
    {
        $listeners = [
            'echo-private:users.' . auth()->user()->id . ',PairFoundEvent' => 'handlePairFound',
        ];
        $listeners['presenceJoining'] = 'chatJoining';
        $listeners['presenceLeaving'] = 'chatLeaving';
        $listeners['presenceHere'] = 'chatHere';
        return $listeners;
    }

    /**
     * @param $users
     * @return void
     */
    public function chatHere($users): void
    {
        foreach ($users as $user) {
            if ($user['sessionId'] != auth()->user()->sessionId) {
                $userChatRepository = app(UserChatRepositoryInterface::class);
                $this->headerUser = $userChatRepository->getMyPartner();
                $this->displayHeader = true;
                $this->isChatActive = true;
                $this->partnerName = $this->headerUser->name;
            }
        }
    }

    /**
     * @param array $user
     * @return void
     */
    public function chatJoining(array $user): void
    {
        if ($user['sessionId'] != auth()->user()->sessionId) {
            $userChatRepository = app(UserChatRepositoryInterface::class);
            $this->headerUser = $userChatRepository->getMyPartner();
            $this->displayHeader = true;
            $this->isChatActive = true;
            $this->partnerName = $this->headerUser->name;
        }
    }

    /**
     * @param array $user
     * @return void
     */
    public function chatLeaving(array $user): void
    {
        $this->reset('headerUser', 'displayHeader', 'isChatActive');
        $this->dispatch('stopChatSubscription');
        $this->handleChatDisconnect();
    }

    /**
     * @return void
     */
    #[On('chatDisconnectHeaderButton')]
    public function handleChatDisconnect(): void
    {
        $chatRepository = app(ChatRepositoryInterface::class);
        $chatRepository->resetMyPairNotLookingForChat();
        $this->reset('headerUser', 'displayHeader', 'isChatActive');
    }

    /**
     * @return void
     */
    #[On('chatNewPairHeaderButton')]
    public function handleChatNewPair(): void
    {
        $chatRepository = app(ChatRepositoryInterface::class);
        $chatRepository->resetMyPair();
        $this->reset('headerUser', 'displayHeader', 'isChatActive');
        $this->tryFindPair();
    }


    /**
     * @param array $data
     * @return void
     */
    public function handlePairFound(array $data): void
    {
        $roomId = $data['roomId'] ?? null;

        if ($roomId) {
            $this->pairId = $roomId;
            $this->dispatch('startChatSubscription', ['pairId' => $roomId]);
        }
    }


    /**
     * @param ChatRepositoryInterface $chatRepository
     * @return void
     */
    public function mount(ChatRepositoryInterface $chatRepository): void
    {
        $this->mySessionId = Session::getId();
        $chatRepository->resetMyPair();
        $this->dispatch('refresh-from-server');
    }

    /**
     * @param array $users
     * @return void
     */
    #[On('echo-presence:room,here')]
    public function setInitialUsers(array $users): void
    {
        $this->onlineUsers = collect($users)
            ->filter(fn($u) => ($u['sessionId'] ?? null) !== $this->mySessionId)
            ->unique('sessionId')
            ->select('id')
            ->values()
            ->pluck('id')
            ->toArray();
        $this->dispatch('countUser', count($this->onlineUsers))->to(UserLiveCounter::class);
        $this->tryFindPair();
    }

    /**
     * @param array $user
     * @return void
     */
    #[On('echo-presence:room,joining')]
    public function handleUserJoining(array $user): void
    {
        $joiningUserId = $user['id'] ?? null;
        if ($joiningUserId && !in_array($joiningUserId, $this->onlineUsers)) {
            $this->onlineUsers[] = $joiningUserId;
        }
        $this->dispatch('countUser', count($this->onlineUsers))->to(UserLiveCounter::class);
        $this->tryFindPair();
    }

    /**
     * @param array $user
     * @return void
     */
    #[On('echo-presence:room,leaving')]
    public function handleUserLeaving(array $user): void
    {
        $leavingUserId = $user['id'] ?? null;
        $this->onlineUsers = array_values(array_filter(
            $this->onlineUsers,
            fn($id) => $id !== $leavingUserId
        ));
        $this->dispatch('countUser', count($this->onlineUsers))->to(UserLiveCounter::class);
        $this->tryFindPair();
    }

    /**
     * @return void
     */
    public function tryFindPair(): void
    {
        if (!$this->hasActivePair()) {
            $chatRepository = app(ChatRepositoryInterface::class);
            $result = $chatRepository->setPairForChat($this->onlineUsers);
            if ($result) {
                $this->handlePairFound(['roomId' => $result->roomId]);
                event(new PairFoundEvent((int)$result->partnerId, $result->roomId, (string)auth()->user()->id));
            }
        }
    }

    /**
     * @return bool
     */
    private function hasActivePair(): bool
    {
        return auth()->user()->tempChat?->paired_user_id !== null;
    }

    /**
     * @return Factory|\Illuminate\Contracts\View\View|View
     */
    public function render(): Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.chat.page-chat');
    }
}
