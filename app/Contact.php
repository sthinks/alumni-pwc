<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Contact
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $contact_title
 * @property string $contact_message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereContactMessage($value)
 * @method static Builder|Contact whereContactTitle($value)
 * @method static Builder|Contact whereCreatedAt($value)
 * @method static Builder|Contact whereId($value)
 * @method static Builder|Contact whereUpdatedAt($value)
 * @method static Builder|Contact whereUserId($value)
 * @mixin Builder
 */
class Contact extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;

    protected $guarded = [];
}
