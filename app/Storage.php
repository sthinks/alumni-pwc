<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Storage
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @method static Builder|Storage newModelQuery()
 * @method static Builder|Storage newQuery()
 * @method static Builder|Storage query()
 * @method static Builder|Storage whereCreatedAt($value)
 * @method static Builder|Storage whereFile($value)
 * @method static Builder|Storage whereId($value)
 * @method static Builder|Storage whereName($value)
 * @method static Builder|Storage whereUpdatedAt($value)
 * @mixin Builder
 */
class Storage extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;
    protected $guarded = [];
}
