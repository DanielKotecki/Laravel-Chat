<?php
declare(strict_types=1);

namespace App\Livewire\Chat;


use App\Events\MessageChat;
use App\Events\MessageRemove;
use App\Livewire\Forms\ChatForm;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;


/**
 *
 */
class ChatComponent extends Component
{

    /**
     * @var string|null
     */
    public ?string $pairId = null;

    /**
     * @var bool
     */
    public bool $isChatActive = false;

    /**
     * @var ChatForm
     */
    public ChatForm $form;

    /**
     * @var Collection
     */
    public Collection $messagesList;
    /**
     * @var string
     */
    public string $partnerName = '';
    /**
     * @var string
     */
    public string $replyToUserName = '';
    /**
     * @var bool
     */
    public bool $firstMessageSent = false; //muszę wysłać pierwszą wiadomość

    /**
     * @return array
     */
    protected function getListeners()
    {

        $listeners['newMessage'] = 'handleMessageChat';
        $listeners['removeMessage'] = 'handleRemoveMessageChat';
        return $listeners;
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->messagesList = collect();
    }

    /**
     * @return Collection
     */
    public function getSortedMessagesListProperty(): Collection
    {
        return $this->messagesList->sortBy('sentAt');
    }

    /**
     * @return void
     */
    public function sendMessage(): void
    {
        if ($this->form->content !== '') {
            if (!$this->firstMessageSent) {
                $this->firstMessageSent = true;
            }
            $this->form->uuid = Str::uuid()->toString();
            $this->form->userId = auth()->id();
            $this->form->sentAt = Carbon::now();

            $messageData = [
                'uuid' => $this->form->uuid,
                'userId' => $this->form->userId,
                'content' => $this->form->content,
                'replyContent' => $this->form->replyContent,
                'replyToUuid' => $this->form->replyToUuid,
                'sentAt' => $this->form->sentAt, // string, nie Carbon!
            ];
            broadcast(new MessageChat(
                chatId: $this->pairId,
                uuid: $this->form->uuid,
                userId: $this->form->userId,
                content: $this->form->content,
                replyContent: $messageData['replyContent'],
                replyToUuid: $messageData['replyToUuid'],
                sentAt: $this->form->sentAt,
            ))->toOthers();
            $this->reset('replyToUserName');
            $this->messagesList->push($messageData);
            $this->dispatch('scroll-to-bottom');
            $this->messagesList = $this->messagesList->sortBy('sentAt')->values();
            $this->form->reset();
        }
    }


    /**
     * @param array $payload
     * @return void
     */
    public function handleMessageChat(array $payload): void
    {
        $this->messagesList->push([
            'uuid' => $payload['uuid'],
            'userId' => $payload['userId'],
            'content' => $payload['content'],
            'replyContent' => $payload['replyContent'],
            'replyToUuid' => $payload['replyToUuid'],
            'sentAt' => Carbon::parse($payload['sentAt']), // przychodzi jako string ISO
        ]);
        $this->dispatch('scroll-to-bottom');
        $this->messagesList = $this->messagesList->sortBy('sentAt')->values();
    }

    /**
     * @param string $suggestion
     * @return void
     */
    public function insertSuggestion(string $suggestion): void
    {
        $this->form->content = $suggestion;
        $this->sendMessage();
    }

    /**
     * @param $uuid
     * @return void
     */
    public function handleRemove($uuid): void
    {
        $this->messagesList->transform(function ($item) use ($uuid) {
            if ($item['uuid'] === $uuid) {
                $item['content'] = null;
            }
            return $item;
        });
        broadcast(new MessageRemove($this->pairId, $uuid))->toOthers();
    }

    /**
     * @param array $payload
     * @return void
     */
    public function handleRemoveMessageChat(array $payload)
    {
        $uuid = $payload['uuid'];
        $this->messagesList->transform(function ($item) use ($uuid) {
            if ($item['uuid'] === $uuid) {
                $item['content'] = null;
            }
            return $item;
        });
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function handleReplay(string $uuid): void
    {
        $myId = auth()->id();
        $message = $this->messagesList->where('uuid', $uuid)->first();
        $this->form->replyToUuid = $uuid;
        $this->form->replyContent = $message['content'];
        if ($message['userId'] === $myId) {
            $this->replyToUserName = __('chat.chat.replying.oneself');
        } else {
            $this->replyToUserName = $this->partnerName;
        }

    }

    /**
     * @return void
     */
    public function handleCancelReply()
    {
        $this->form->reset('replyContent', 'replyToUuid');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.chat.chat-component', ['myId' => auth()->id()]);
    }
}
