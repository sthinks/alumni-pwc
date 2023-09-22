<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\TermCondition
 *
 * @property int $id
 * @property string $type
 * @property string $term
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition whereTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermCondition whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 */
class TermCondition extends Model
{
    use LogsActivity;
    const TYPES = ['clarification_text', 'user_agreement'];
    protected $guarded = [];

    /**
     * The users who have this hobby.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_terms')->withTimestamps();
    }
}
