<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class Tag extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    protected $primaryKey = "uuid";
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'language_id',
        'source_uuid',   // MUSI TU BYĆ!
    ];

    /**
     * @return BelongsTo
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'source_uuid', 'uuid');
    }

    /**
     *
     * @return HasMany
     */
    public function translatedTags(): HasMany
    {
        return $this->hasMany(Tag::class, 'source_uuid', 'uuid');
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
}
