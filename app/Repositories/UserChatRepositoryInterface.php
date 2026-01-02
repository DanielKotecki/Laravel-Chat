<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Livewire\Forms\TempUserForm;
use App\Models\User;

/**
 *
 */
interface UserChatRepositoryInterface
{
    /**
     * @param TempUserForm $form
     * @return User
     */
    public function createTempUser(TempUserForm $form): User;

    /**
     * @param int $userId
     * @return bool
     */
    public function setDeleteTempUser(int $userId): bool;

    /**
     * @param User $user
     * @param string $newSessionId
     * @return bool
     */
    public function updateSessioId(User $user, string $newSessionId): bool;

    /**
     * @return User|null
     */
    public function getAuthUser(): ?User;

    /**
     * @return User|null
     */
    public function getMyPartner(): ?User;

    public function addFilters(array $filters): void;
    public function deleteFilters(): void;
    public function getFilters(): ?array;
}
