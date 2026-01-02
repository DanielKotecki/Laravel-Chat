<?php
declare(strict_types=1);

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;

/**
 *
 */
class ChatForm extends Form
{
    /**
     * @var string
     */
    public string $uuid = '';
    /**
     * @var int
     */
    public int $userId = 0;
    /**
     * @var string
     */
    public string $content = '';
    /**
     * @var string|null
     */
    public ?string $replyContent = null;
    /**
     * @var string|null
     */
    public ?string $replyToUuid = null;
    /**
     * @var Carbon|null
     */
    public ?Carbon $sentAt = null;
}
