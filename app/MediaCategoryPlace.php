<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\MediaCategoryPlace
 *
 * @property int $id
 * @property int $media_id
 * @property int $media_category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|MediaCategoryPlace newModelQuery()
 * @method static Builder|MediaCategoryPlace newQuery()
 * @method static Builder|MediaCategoryPlace query()
 * @method static Builder|MediaCategoryPlace whereCreatedAt($value)
 * @method static Builder|MediaCategoryPlace whereId($value)
 * @method static Builder|MediaCategoryPlace whereMediaCategoryId($value)
 * @method static Builder|MediaCategoryPlace whereMediaId($value)
 * @method static Builder|MediaCategoryPlace whereUpdatedAt($value)
 * @mixin Builder
 */
class MediaCategoryPlace extends Model
{
}
