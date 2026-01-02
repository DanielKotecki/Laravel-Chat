<?php
declare(strict_types=1);
namespace App\Repositories\chat;

use App\DTO\PairForChatDto;
use App\Models\User;

/**
 *
 */
interface ChatRepositoryInterface
{
    /**
     * @param array $online_id
     * @return PairForChatDto|null
     */
    public function setPairForChat(array $online_id): ?PairForChatDto;

    /**
     * @param array $online_id
     * @return User|null
     */
    public function getUserForPair(array $online_id): ?User;

    /**
     * @return void
     */
    public function resetMyPair(): void;

    /**
     * @return void
     */
    public function resetMyPairNotLookingForChat(): void;
}
