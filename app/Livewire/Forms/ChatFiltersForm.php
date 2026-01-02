<?php
declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Form;

/**
 *
 */
class ChatFiltersForm extends Form
{
    /**
     * @var bool
     */
    public bool $male = true;
    /**
     * @var bool
     */
    public bool $female = false;
    /**
     * @var bool
     */
    public bool $other = false;
    /**
     * @var array
     */
    public array $genders = [];
    /**
     * @var string
     */
    public string $age = 'all';
    /**
     * @var array
     */
    public array $tags = [];

}
