<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Enums\GenderEnum;
use App\Livewire\Forms\TempUserForm;
use App\Repositories\AgeRangeRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\UserChatRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 *
 */
#[Layout('components.layouts.guest')]
class StartChatForm extends Component
{
    /**
     * @var array
     */
    public array $tags;
    /**
     * @var array
     */
    public array $ageRanges;
    /**
     * @var GenderEnum
     */
    public GenderEnum $gender;
    /**
     * @var TempUserForm
     */
    public TempUserForm $form;

    /**
     * @param $uuid_tag
     * @return string
     */
    public function maxTags($uuid_tag): string
    {
        $currentTagCount = count($this->form->tags);
        $tagAlreadySelected = in_array($uuid_tag, $this->form->tags);

        if ($currentTagCount >= 5 && !$tagAlreadySelected) {
            return 'disabled';
        }
        return '';
    }

    /**
     * @param AgeRangeRepositoryInterface $ageRangeRepository
     * @param TagRepositoryInterface $tagRepository
     * @return void
     */
    public function mount(AgeRangeRepositoryInterface $ageRangeRepository,
                          TagRepositoryInterface      $tagRepository): void
    {
        $currentLocale = App::getLocale();
        $this->ageRanges = $ageRangeRepository->getAllAgeRangeAsArray();
        $this->tags = $tagRepository->getTagsByLangAsArray($currentLocale);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.start-chat-form');
    }

    /**
     * @param UserChatRepository $tempUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(UserChatRepository $tempUser)
    {
        $this->form->validate();
        $response = $tempUser->createTempUser($this->form);
        Auth::login($response);

        // Opcjonalnie: odśwież sesję
        request()->session()->regenerate();

        $tempUser->updateSessioId($response, Session::getId());
        // Przekierowanie
        return redirect()->intended('/chat');
    }
}
