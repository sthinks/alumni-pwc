<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class SecondMailVerify
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|SecondMailVerify newModelQuery()
 * @method static Builder|SecondMailVerify newQuery()
 * @method static Builder|SecondMailVerify query()
 * @method static Builder|SecondMailVerify whereCreatedAt($value)
 * @method static Builder|SecondMailVerify whereId($value)
 * @method static Builder|SecondMailVerify whereToken($value)
 * @method static Builder|SecondMailVerify whereUpdatedAt($value)
 * @method static Builder|SecondMailVerify whereUserId($value)
 */
class SecondMailVerify extends Model
{
    protected $fillable = [
        'user_id',
        'token',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
