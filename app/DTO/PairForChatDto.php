<?php

namespace App\DTO;

/**
 *
 */
class PairForChatDto
{
    /**
     * @param int $partnerId
     * @param string $roomId
     */
    public function __construct(public int $partnerId, public string $roomId)
    {

    }
}
