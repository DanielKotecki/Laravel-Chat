<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\AgeRange;
use Illuminate\Support\Collection;

/**
 *
 */
class AgeRangeRepository implements AgeRangeRepositoryInterface
{
    /**
     * @return array
     */
    public function getAllAgeRangeAsArray():array{
        return AgeRange::all()->pluck('age_range','uuid')->toArray();
    }

    /**
     * @return Collection
     */
    public function getAllAgeRangeForSelect():Collection
    {
        return AgeRange::all()->map(function (AgeRange $range) {
            return [
                'id' => $range->uuid,
                'name' => $range->age_range,
            ];
        });
    }
}
