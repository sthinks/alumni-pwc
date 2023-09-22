<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class AnnouncementCategory
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AnnouncementCategory newModelQuery()
 * @method static Builder|AnnouncementCategory newQuery()
 * @method static Builder|AnnouncementCategory query()
 * @method static Builder|AnnouncementCategory whereCreatedAt($value)
 * @method static Builder|AnnouncementCategory whereId($value)
 * @method static Builder|AnnouncementCategory whereName($value)
 * @method static Builder|AnnouncementCategory whereSlug($value)
 * @method static Builder|AnnouncementCategory whereUpdatedAt($value)
 */
class AnnouncementCategory extends Model
{
    protected $guarded = [];
}
