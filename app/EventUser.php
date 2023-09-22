<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\EventUser
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property string|null $event_ticket
 * @property int $ticket_is_used
 * @property string|null $ticket_used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|EventUser newModelQuery()
 * @method static Builder|EventUser newQuery()
 * @method static Builder|EventUser query()
 * @method static Builder|EventUser whereCreatedAt($value)
 * @method static Builder|EventUser whereEventId($value)
 * @method static Builder|EventUser whereEventTicket($value)
 * @method static Builder|EventUser whereId($value)
 * @method static Builder|EventUser whereTicketIsUsed($value)
 * @method static Builder|EventUser whereTicketUsedAt($value)
 * @method static Builder|EventUser whereUpdatedAt($value)
 * @method static Builder|EventUser whereUserId($value)
 * @mixin Builder
 */
class EventUser extends Model
{
}
