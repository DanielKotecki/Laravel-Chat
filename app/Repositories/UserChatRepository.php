<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Livewire\Forms\TempUserForm;
use App\Models\User;
use Illuminate\Support\Str;

/**
 *
 */
class UserChatRepository implements UserChatRepositoryInterface
{
    /**
     * @var TagRepositoryInterface
     */
    private TagRepositoryInterface $tagRepository;

    /**
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;

    }

    /**
     * @param TempUserForm $form
     * @return User
     */
    public function createTempUser(TempUserForm $form): User
    {
        $user = User::create([
            'name' => $form->nickname ? $form->nickname : 'Anonymous-' . Str::uuid()->toString(),
            'email' => 'Anonymous-Email' . Str::uuid()->toString(),
            'password' => bcrypt('password'),
            'temp_user' => true,

        ]);
        $user->tempChat()->create([
            'gender' => $form->gender,
            'age_range_uuid' => $form->age,
        ])->tags()->attach($form->tags);

        return $user->load(['tempChat', 'tempChat.tags']);

    }

    /**
     * @param User $user
     * @param string $newSessionId
     * @return bool
     */
    public function updateSessioId(User $user, string $newSessionId): bool
    {
        return $user->update(['session_id' => $newSessionId]);
    }

    /**
     * @return User|null
     */
    public function getAuthUser(): ?User
    {

        $data = User::with(['tempChat', 'tempChat.tags'])->find(auth()->id());
        if ($data === null) {
            return null;
        }
        $tags = $this->tagRepository->getLocalizedTagsBySourceUuids($data->tempChat->tags()->get());

        $data->setRelation('tags', $tags);
        return $data;
    }

    /**
     * @return User|null
     */
    public function getMyPartner(): ?User
    {
        $partnerId = auth()->user()->tempChat->paired_user_id;
        if ($partnerId) {
            $data = User::with(['tempChat', 'tempChat.tags', 'tempChat.age'])->find($partnerId);
            if ($data === null) {
                return null;
            }
            $tags = $this->tagRepository->getLocalizedTagsBySourceUuids($data->tempChat->tags()->get());

            $data->setRelation('tags', $tags);
            return $data;
        }
        return null;
    }


    /**
     * @param int $userId
     * @return bool
     */
    public function setDeleteTempUser(int $userId): bool
    {
        return User::find($userId)->update(['temp_user_to_delete' => true]);
    }

    public function addFilters(array $filters): void
    {
        auth()->user()->tempChat->update(['filters' => $filters]);
    }

    public function deleteFilters(): void
    {
        auth()->user()->tempChat->update(['filters' => null]);
    }

    public function getFilters(): ?array
    {
        return auth()->user()->tempChat->filters;
    }
}
