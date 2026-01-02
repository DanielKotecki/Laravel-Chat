<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 *
 */
class PairFoundEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public int $userId, public string $roomId, public string $partnerId)
    {
        //
    }


    /**
     * @return \Illuminate\Broadcasting\PrivateChannel[]
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('users.' . $this->userId),
        ];
    }

    /**
     * @return array
     */
    public function broadcastWith(): array
    {
        return ['roomId' => $this->roomId, 'partnerId' => $this->partnerId];
    }
}
