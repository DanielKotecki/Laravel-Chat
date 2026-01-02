<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

/**
 *
 */
class TagRepository implements TagRepositoryInterface
{
    /**
     * @param string $code
     * @return array
     */
    public function getTagsByLangAsArray(string $code): array
    {
        return Tag::whereHas('language',function ($query) use ($code){
            $query->where('code',$code);
        })->pluck('name', 'uuid')->toArray();
    }

    /**
     * @param Collection|null $sourceUuids
     * @return Collection
     */
    public function getLocalizedTagsBySourceUuids(?Collection $sourceUuids = null): Collection
    {
        $languageCode = App::getLocale();
        $uuids = ($sourceUuids ?? collect())
            ->whereNotNull('uuid') // Usuwamy ewentualne wartości null
            ->pluck('uuid')
            ->toArray();

        return Tag::query()
            ->whereHas('language', function ($query) use ($languageCode) {
                $query->where('code', $languageCode);
            })
            ->when(!empty($uuids), function ($query) use ($uuids) {
                return $query->whereIn('source_uuid', $uuids);
            })
            ->get();
    }
}
