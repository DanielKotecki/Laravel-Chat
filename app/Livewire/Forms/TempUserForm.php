<?php
declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Enums\GenderEnum;
use Livewire\Attributes\Validate;
use Livewire\Form;

/**
 *
 */
class TempUserForm extends Form
{
    /**
     * @var string|null
     */
    public ?string $nickname = null;
    /**
     * @var GenderEnum
     */
    #[Validate(['required'])]
    public GenderEnum $gender;

    /**
     * @var string
     */
    #[Validate(['required'])]
    public string $age;
    /**
     * @var array
     */
    #[Validate(['required', 'array', 'min:1'])]
    public array $tags = [];
    /**
     * @var bool
     */
    #[Validate(['accepted'])]
    public bool $accept_terms;

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            // Poprawne klucze dla niestandardowych komunikatów
            'gender.required' => __('validation.gender.required'),
            'gender.in' => __('validation.gender.in'),
            'age.required' => __('validation.age.required'),
            'age.numeric' => __('validation.age.numeric'),
            'tags.required' => __('validation.tags.required'),
            'tags.array' => __('validation.tags.array'),
            'tags.min' => __('validation.tags.min'),
            'accept_terms.accepted' => __('validation.accept_terms.accepted'),
        ];
    }

}
