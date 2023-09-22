<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\City
 *
 * @property int $id
 * @property int $plate
 * @property string $city
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City query()
 * @method static Builder|City whereCity($value)
 * @method static Builder|City whereCreatedAt($value)
 * @method static Builder|City whereId($value)
 * @method static Builder|City wherePlate($value)
 * @method static Builder|City whereUpdatedAt($value)
 * @mixin Builder
 */
class City extends Model
{
    protected $guarded = [];
}
