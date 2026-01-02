<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 */
class TempChat extends Model
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
        'user_id',
        'paired_user_id',
        'chat_room_id',
        'gender',
        'filters',
        'age_range_uuid',
        'looking_for_chat'
    ];
    /**
     * @var string[]
     */
    protected $casts = [
        'looking_for_chat' => 'boolean',
        'filters' => 'array',
    ];

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(TempChat::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_temp_user_pivot', 'temp_chat_uuid', 'tag_uuid');
    }

    /**
     * @return HasOne
     */
    public function age(): hasOne
    {
        return $this->hasOne(AgeRange::class, 'uuid', 'age_range_uuid');
    }
}
