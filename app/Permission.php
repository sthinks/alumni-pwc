<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Class Permission
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string|null $crm
 * @property string $name
 * @property string $group
 * @property string $slug
 * @property string $desc
 * @property int $editable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereCrm($value)
 * @method static Builder|Permission whereDesc($value)
 * @method static Builder|Permission whereEditable($value)
 * @method static Builder|Permission whereGroup($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereSlug($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 */
class Permission extends Model
{
    public const GROUP_PWC = 'pwc';
    public const GROUP_ALUMNI = 'alumni';
    public const GROUP_SYSTEM = 'system';
    public const GROUP_MARKETING = 'marketing';
    protected $guarded = [];

    /**
     * Users belong to the permission
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_permissions')->withTimestamps();
    }
}
