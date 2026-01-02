<?php
declare(strict_types=1);
namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 *
 */
interface AgeRangeRepositoryInterface
{
    /**
     * @return array
     */
    public function getAllAgeRangeAsArray():array;

    /**
     * @return Collection
     */
    public function getAllAgeRangeForSelect():Collection;
}
