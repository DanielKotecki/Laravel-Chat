<?php
declare(strict_types=1);
namespace App\Livewire\Chat;

use App\Enums\GenderEnum;
use App\Livewire\Forms\ChatFiltersForm;
use App\Repositories\AgeRangeRepositoryInterface;
use App\Repositories\TagRepositoryInterface;

use App\Repositories\UserChatRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mary\Traits\Toast;

/**
 *
 */
class SidebarFilters extends Component
{
    use Toast;

    /**
     * @var array
     */
    public array $tags;
    /**
     * @var Collection
     */
    public Collection $ageRanges;
    /**
     * @var GenderEnum
     */
    public GenderEnum $gender;
    /**
     * @var ChatFiltersForm
     */
    public ChatFiltersForm $form;
    /**
     * @var bool
     */
    public bool $male = false;
    /**
     * @var bool
     */
    public bool $female = false;
    /**
     * @var bool
     */
    public bool $other = false;
    /**
     *
     */
    private const SESSION_FILTERS_KEY = 'filters';

    /**
     * @param AgeRangeRepositoryInterface $ageRangeRepository
     * @param TagRepositoryInterface $tagRepository
     * @return void
     */
    public function mount(AgeRangeRepositoryInterface $ageRangeRepository,
                          TagRepositoryInterface      $tagRepository,
                          UserChatRepositoryInterface $userChatRepository): void
    {
        $currentLocale = App::getLocale();
        $this->ageRanges = $ageRangeRepository->getAllAgeRangeForSelect();
        $this->tags = $tagRepository->getTagsByLangAsArray($currentLocale);
        $myFilters = $userChatRepository->getFilters();
        if ($myFilters) {
            // Wypełnij podstawowe pola
            $this->form->age = $myFilters['age'] ?? 'all';
            $this->form->tags = $myFilters['tags'] ?? [];

            // Odtwórz checkboxy płci
            $savedGenders = $myFilters['genders'] ?? [];
            $this->male = in_array(GenderEnum::MALE->value, $savedGenders);
            $this->female = in_array(GenderEnum::FEMALE->value, $savedGenders);
            $this->other = in_array(GenderEnum::OTHER->value, $savedGenders);
        }

    }

    /**
     * @return void
     */
    public function saveFilters(UserChatRepositoryInterface $userChatRepository): void
    {
        // Zbieramy dane do sesji
        $this->form->reset('genders');
        if ($this->male) $this->form->genders[] = GenderEnum::MALE;
        if ($this->female) $this->form->genders[] = GenderEnum::FEMALE;
        if ($this->other) $this->form->genders[] = GenderEnum::OTHER;

        $filters = [
            'genders' => $this->form->genders,
            'age' => $this->form->age === 'all' ? null : $this->form->age,
            'tags' => $this->form->tags,
        ];
        $userChatRepository->addFilters($filters);
        Session::put(self::SESSION_FILTERS_KEY, $filters);
        $this->success(__('sidebar_filters.toasts.success'));
        $this->dispatch('stopChatSubscription');
        $this->dispatch('chatDisconnectHeaderButton')->to(PageChat::class);
        $this->dispatch('chatNewPairHeaderButton')->to(PageChat::class);
    }

    /**
     * @return void
     */
    public function resetFilters(UserChatRepositoryInterface $userChatRepository): void
    {
        $this->male = false;
        $this->female = false;
        $this->other = false;
        $this->form->reset();

        $userChatRepository->deleteFilters();
        $this->success(__('sidebar_filters.toasts.success-reset'));;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.chat.sidebar-filters');
    }
}
