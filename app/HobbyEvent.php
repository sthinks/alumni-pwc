<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\HobbyEvent
 *
 * @property int $id
 * @property int $hobby_id
 * @property int $event_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|HobbyEvent newModelQuery()
 * @method static Builder|HobbyEvent newQuery()
 * @method static Builder|HobbyEvent query()
 * @method static Builder|HobbyEvent whereCreatedAt($value)
 * @method static Builder|HobbyEvent whereEventId($value)
 * @method static Builder|HobbyEvent whereHobbyId($value)
 * @method static Builder|HobbyEvent whereId($value)
 * @method static Builder|HobbyEvent whereUpdatedAt($value)
 * @mixin Builder
 */
class HobbyEvent extends Model
{
}
