<?php
declare(strict_types=1);

namespace App\Repositories\chat;

use App\DTO\PairForChatDto;
use App\Models\User;
use Illuminate\Support\Str;


/**
 *
 */
class ChatRepository implements ChatRepositoryInterface
{
    /**
     * @param array $online_id
     * @return PairForChatDto|null
     */
    public function setPairForChat(array $online_id): ?PairForChatDto
    {
        $userForPaired = $this->getUserForPair($online_id);
        if ($userForPaired == null) {
            return null;
        }
        $roomId = Str::uuid()->toString();
        auth()->user()->tempChat()->update([
            'paired_user_id' => $userForPaired->id,
            'chat_room_id' => $roomId,
            'looking_for_chat' => false,
        ]);
        $userForPaired->tempChat()->update([
            'paired_user_id' => auth()->user()->id,
            'chat_room_id' => $roomId,
            'looking_for_chat' => false,
        ]);
        return new PairForChatDto($userForPaired->id, $roomId);
    }

    /**
     * @param array $online_id
     * @return User|null
     */
    public function getUserForPair(array $online_id): ?User
    {
        if (empty($online_id)) {
            return null;
        }

        $currentUser = auth()->user();
        $myTempChat = $currentUser->tempChat;
        $myFilters = $myTempChat->filters ?? [];

        // Bazowe zapytanie – wszyscy online i szukający czatu
        $candidates = User::whereHas('tempChat', function ($q) {
            $q->where('looking_for_chat', true);
        })
            ->whereIn('users.id', $online_id)
            ->where('users.id', '!=', $currentUser->id)
            ->with(['tempChat', 'tempChat.tags', 'tempChat.age'])
            ->get();

        if ($candidates->isEmpty()) {
            return null;
        }

        // Dwukierunkowe filtrowanie w PHP
        $matchedCandidates = $candidates->filter(function (User $candidate) use ($myFilters, $currentUser) {
            $candidateTempChat = $candidate->tempChat;
            $candidateFilters = $candidateTempChat->filters ?? [];

            // 1. Czy JA spełniam filtry KANDYDATA?
            if (!$this->userMatchesFilters($currentUser, $candidateFilters)) {
                return false;
            }

            // 2. Czy KANDYDAT spełnia MOJE filtry?
            if (!$this->userMatchesFilters($candidate, $myFilters)) {
                return false;
            }

            return true;
        });
        return $matchedCandidates->isNotEmpty() ? $matchedCandidates->random() : null;
    }

    /**
     *
     * @param User $userToCheck Użytkownik do sprawdzenia
     * @param array $filters Filtry do spełnienia
     * @return bool
     */
    private function userMatchesFilters(User $userToCheck, array $filters): bool
    {
        // akceptuje wszystkich jeśli brak filtrów
        if (empty($filters['genders']) && empty($filters['age']) && empty($filters['tags'])) {
            return true;
        }

        $tempChat = $userToCheck->tempChat;

        if (!empty($filters['genders'])) {
            $userGender = $tempChat->gender; // np. 'male', 'female', 'other'
            if (!in_array($userGender, $filters['genders'])) {
                return false;
            }
        }
        if (!empty($filters['age'])) {
            if ($tempChat->age_range_uuid !== $filters['age']) {
                return false;
            }
        }
        if (!empty($filters['tags'])) {
            $requiredTagUuids = $filters['tags'];
            $userTagUuids = $tempChat->tags->pluck('uuid')->toArray();

            // array_intersect zwraca wspólne elementy
            // Jeśli nie ma żadnego wspólnego → nie pasuje
            if (empty(array_intersect($requiredTagUuids, $userTagUuids))) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return void
     */
    public function resetMyPair(): void
    {
        auth()->user()->tempChat()->update([
            'paired_user_id' => null,
            'chat_room_id' => null,
            'looking_for_chat' => true,
        ]);
    }

    /**
     * @return void
     */
    public function resetMyPairNotLookingForChat(): void
    {
        auth()->user()->tempChat()->update([
            'paired_user_id' => null,
            'chat_room_id' => null,
            'looking_for_chat' => false,
        ]);
    }
}
