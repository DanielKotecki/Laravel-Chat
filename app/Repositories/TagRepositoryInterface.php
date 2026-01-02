<?php
declare(strict_types=1);
namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 *
 */
interface TagRepositoryInterface
{
    /**
     * @param string $code
     * @return array
     */
    public function getTagsByLangAsArray(string $code): array;

    /**
     * @param Collection|null $sourceUuids
     * @return Collection
     */
    public function getLocalizedTagsBySourceUuids(?Collection $sourceUuids = null): Collection;
}
