<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\JobShare
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $company
 * @property string|null $position
 * @property string|null $level
 * @property City|null $location
 * @property int|null $experience
 * @property string|null $detail
 * @property Carbon|null $date
 * @property Carbon|null $valid_till
 * @property string|null $link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|JobShare newModelQuery()
 * @method static Builder|JobShare newQuery()
 * @method static Builder|JobShare query()
 * @method static Builder|JobShare whereCompany($value)
 * @method static Builder|JobShare whereCreatedAt($value)
 * @method static Builder|JobShare whereDate($value)
 * @method static Builder|JobShare whereDetail($value)
 * @method static Builder|JobShare whereExperience($value)
 * @method static Builder|JobShare whereId($value)
 * @method static Builder|JobShare whereLevel($value)
 * @method static Builder|JobShare whereLink($value)
 * @method static Builder|JobShare whereLocation($value)
 * @method static Builder|JobShare wherePosition($value)
 * @method static Builder|JobShare whereUpdatedAt($value)
 * @method static Builder|JobShare whereUserId($value)
 * @method static Builder|JobShare whereValidTill($value)
 * @mixin Builder
 * @property string|null $skills
 * @method static Builder|JobShare whereSkills($value)
 */
class JobShare extends Model
{
    protected $casts = [
        'valid_till' => 'datetime',
        'date' => 'datetime',
    ];

    protected $guarded = [];

    /**
     * Job offer location
     *
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'location');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
