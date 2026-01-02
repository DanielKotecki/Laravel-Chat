<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class AgeRange extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    protected $primaryKey = "uuid";
    /**
     * @var string[]
     */
    protected $fillable = ['age_range'];
}
