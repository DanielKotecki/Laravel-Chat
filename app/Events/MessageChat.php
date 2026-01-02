<?php
declare(strict_types=1);
namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 *
 */
class MessageChat implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * @param string $chatId
     * @param string $uuid
     * @param int $userId
     * @param string $content
     * @param string|null $replyContent
     * @param string|null $replyToUuid
     * @param Carbon $sentAt
     */
    public function __construct(
        public readonly string  $chatId,
        public readonly string  $uuid,
        public readonly int     $userId,
        public readonly string  $content,
        public readonly ?string  $replyContent,
        public readonly ?string  $replyToUuid,
        public readonly Carbon  $sentAt,
    )
    {
    }

    /**
     * @return PresenceChannel
     */
    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel('chat.' . $this->chatId);
    }

    /**
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'uuid' => $this->uuid,
            'userId' => $this->userId,
            'content' => $this->content,
            'replyContent' => $this->replyContent,
            'replyToUuid' => $this->replyToUuid,
            'sentAt' => $this->sentAt,
        ];
    }
}
