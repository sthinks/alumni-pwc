<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\EventGuest
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|EventGuest newModelQuery()
 * @method static Builder|EventGuest newQuery()
 * @method static Builder|EventGuest query()
 * @method static Builder|EventGuest whereCreatedAt($value)
 * @method static Builder|EventGuest whereEventId($value)
 * @method static Builder|EventGuest whereId($value)
 * @method static Builder|EventGuest whereUpdatedAt($value)
 * @method static Builder|EventGuest whereUserId($value)
 * @mixin Builder
 */
class EventGuest extends Model
{
}
